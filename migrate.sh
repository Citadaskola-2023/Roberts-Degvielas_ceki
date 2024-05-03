#!/bin/bash

# Load environment variables from .env file
set -a
source .env
set +a

# Define the path to the migrations folder
MIGRATIONS_DIR="migrations"

# Get the last executed migration number from the file
LAST_MIGRATION=$(cat $MIGRATIONS_DIR/last_migration.txt 2>/dev/null)

# Set default value of 0 if LAST_MIGRATION is empty or not set
LAST_MIGRATION=${LAST_MIGRATION:-0}

# Define a temporary variable to store SQL statements
# Set the character encoding for the SQL connection
TEMPORARY_BATCH_SQL="SET NAMES utf8mb4;"

# If last migration is not set or empty, create the database
if [ "$LAST_MIGRATION" -eq 0 ]; then
    echo "Creating database $DB_NAME..."
    docker exec -i $(docker-compose ps -q mysql) mysql -h$DB_HOST -u$DB_USER -p$DB_PASSWORD -e "CREATE DATABASE IF NOT EXISTS $DB_NAME;"
    echo "0" > $MIGRATIONS_DIR/last_migration.txt
fi

# Iterate over each SQL file in the migrations folder
for SQL_FILE in $(ls $MIGRATIONS_DIR/*.sql | sort -n); do
   # Extract the migration number from the file name
     MIGRATION_NUMBER=$(basename $SQL_FILE | cut -d'_' -f1)

    # Check if the migration file number is greater than the last executed migration
    if [ "$MIGRATION_NUMBER" -gt "$LAST_MIGRATION" ]; then
        echo "Running migration $SQL_FILE..."

        # Append the SQL statement from the file to the temporary variable
        TEMPORARY_BATCH_SQL="${TEMPORARY_BATCH_SQL}$(cat $SQL_FILE)"

        # Update the last executed migration number
        echo $MIGRATION_NUMBER > $MIGRATIONS_DIR/last_migration.txt
    fi
done

# Check if there are any SQL statements to execute
if [ ! -z "$TEMPORARY_BATCH_SQL" ]; then
  echo "Running all migrations..."
  docker exec -i $(docker-compose ps -q mysql) mysql -h$DB_HOST -u$DB_USER -p$DB_PASSWORD $DB_NAME <<< "$TEMPORARY_BATCH_SQL"
fi

echo "All migrations have been executed."
