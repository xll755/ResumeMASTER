# ResumeMASTER

## About

## Usage

ResumeMASTER is a web application that is deployed on Docker containers.
This means that running the application is as simple as fetching the source
code, building the contains, and accessing the application through your browser
of choice.

### Quick start guide

#### Clone repository

```bash
# Clone repository & navigate to local directory
git clone https://github.com/xll755/ResumeMASTER.git
cd ~/ResumeMASTER
```

#### Configure secrets

ResumeMASTER employs the use of a `.env` file for managing secrets.
This file is **NOT** tracked by the repository due to its sensitive nature and
therefore must be created individually by each user as they see fit.

##### Configure database

```bash
# Create an ".env" file if you don't have one created already.
touch ./www/.env

$EDITOR ./www/.env
```

The database environment variables should be defined as seen here:

```text
DB_SERVER=db
MYSQL_DATABASE=<your_db_name>
MYSQL_USER=<your_user_name>
MYSQL_PASSWORD=<you_user_pwd>
MYSQL_ALLOW_EMPTY_PASSWORD=<you_boolean_preference>
```

##### Add API key

```bash
# Place secrets inside .env file
echo "API_KEY=<your_api_key>" >> ./www/.env
```

> [!IMPORTANT]
> ResumeMASTER uses Google's genAI Gemini model for any genai improvements made
> to user input.
> This means that for this functionality to be accessible you must acquire and
> include an API key.

#### Initial run

```bash
# Build & run the application
docker compose up --build
# Access the application locally
firefox localhost

# to stop containers
docker compose stop
# to stop and remove containers
docker compose down # THIS COMMAND WILL **DELETE** ANY DATA IN THE DATABASE
```

#### Subsequent runs

After building the Docker containers that ResumeMASTER uses to host is server
and database on, subsequent running of the application only requires running the
containers.

```bash
# Navigate to application directory
cd ~/ResumeMASTER

# if "stop" was used to shutdown containers
docker compose start
# if "down" was used to shutdown containers
docker compose up

# Access the application locally
firefox localhost

# to stop containers
docker compose stop
# to stop and remove containers
docker compose down # THIS COMMAND WILL **DELETE** ANY DATA IN THE DATABASE
```

### Application flow
