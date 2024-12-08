# ResumeMASTER

## About

## TOC

[Usage](#usage)
[Quick Start Guide](#quick-start-guide)
[Application Flow](#application-flow)

## Usage

ResumeMASTER is a web application that is deployed on Docker containers.
This means that running the application is as simple as fetching the source
code, building the contains, and accessing the application through your browser
of choice.

### Quick Start Guide

#### Clone Repository

```bash
# Clone repository & navigate to local directory
git clone https://github.com/xll755/ResumeMASTER.git
cd ~/ResumeMASTER
```

#### Configure Secrets

ResumeMASTER employs the use of a `.env` file for managing secrets.
This file is **NOT** tracked by the repository due to its sensitive nature and
therefore must be created individually by each user as they see fit.

##### Configure Database

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

##### Add API Key

```bash
# Place secrets inside .env file
echo "API_KEY=<your_api_key>" >> ./www/.env
```

> [!IMPORTANT]
> ResumeMASTER uses Google's genAI Gemini model for any genai improvements made
> to user input.
> This means that for this functionality to be accessible you must acquire and
> include an API key.

#### Initial Run

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

#### Subsequent Runs

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

### Application Flow

After successfully staring and then accessing ResumeMASTER using your favorite
browser, its finally time to go about creating, editing, and downloading your
resume!

#### Account Creation

Start off your journey by creating an account to control your resumes with.

##### Account Field Requirements

- Usernames must be alphanumeric, 1-15 chars in length
- Emails are checked against RFC 822
- Passwords must:
  - be >= 8 chars
  - contain >= 1 lowercase letter
  - contain >= 1 uppercase letter
  - contain >= 1 digit

#### Resume Creation

Create a resume either entirely by yourself or by leveraging the power of
generative AI to level-up you resume!

##### Required Fields

- Name
- City, State, ZIP ( Location information )
- Phone number & email address ( Contact information )
- Objective statement
- First job title
- First job start date
- First job last date
- First job work experience
- Education

##### Leveraging Generative AI

All it takes to upgrade you resume's fields is a simple button click!
Simply check the "Would you like AI to improve this?" box on the input fields
where its available and Google's Gemini will aid you in expressing yourself to
potential employers.
You will have a chance to review and edit anything, including your own work,
before you download it so feel free to explore how you would like to present
yourself!
