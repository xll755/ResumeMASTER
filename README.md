# ResumeMASTER

## About

ResumeMASTER is a tool designed to help you create a resume that empowers you
to present your best self to anyone who reads it!
This is accomplished through guiding you through the process of creating a basic
yet powerful resume and allowing you to enhance it through leveraging the power
of generative AI if you desire.
This means that you can not only express yourself directly, but can get
meaningful feedback & improvement on certain sections of your resumes!

ResumeMASTER gives you the ability to create and manage multiple resumes,
allowing you to explore exactly what you would like to put forward without
having to worry about losing anything you've previously created.
Once you're happy with any given resume you can download a copy of it as a PDF
for your personal use!

## TOC

[Usage](#usage)

[Quick Start Guide](#quick-start-guide)

[Clone Repository](#clone-repository)

[Configure Secrets](#configure-secrets)

[Configure Database](#configure-database)

[Add API Key](#add-api-key)

[Initial Run](#initial-run)

[Subsequent Runs](#subsequent-runs)

[Application Flow](#application-flow)

[Account Creation](#account-creation)

[Account Field Requirements](#account-field-requirements)

[Resume Creation](#resume-creation)

[Required Fields](#required-fields)

[Leveraging Generative AI](#leveraging-generative-ai)

[Manage Resumes](#manage-resumes)

## Usage

ResumeMASTER is a web application that is deployed on Docker containers.
This means that running the application is as simple as fetching the source
code, building the containers, and accessing the application through your browser
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
# Create an ".env" file if you don't have one created already
touch ./www/.env

# Edit the ".env" file using your default ( favorite ) text editor
$EDITOR ./www/.env
```

The database environment variables should be defined as seen here:

```text
DB_SERVER=db
MYSQL_DATABASE=<your_db_name>
MYSQL_USER=<your_user_name>
MYSQL_PASSWORD=<you_user_pwd>
MYSQL_ALLOW_EMPTY_PASSWORD=<your_int_boolean_preference>
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

> [!NOTE]
> **FOR POWER USERS**
>
> If you would like to use a different generative AI, feel free to edit the
> Python  script located at `./www/back-end/ai-api-caller.py` to suit your
> needs!

#### Initial Run

```bash
# Build & Run the application
docker compose up --build
# Access the application locally in your favorite internet browser
firefox localhost

# Stop containers
docker compose stop
# Stop and Remove containers
docker compose down # THIS COMMAND WILL **DELETE** ANY DATA IN THE DATABASE
```

#### Subsequent Runs

After building the Docker containers that ResumeMASTER uses to host its web
server and database on, subsequent running of the application only requires
running the containers.

```bash
# Navigate to application directory
cd ~/ResumeMASTER

# If "stop" was used to shutdown containers
docker compose start
# If "down" was used to shutdown containers
docker compose up

# Access the application locally
firefox localhost

# Stop containers
docker compose stop
# Stop and Remove containers
docker compose down # THIS COMMAND WILL **DELETE** ANY DATA IN THE DATABASE
```

### Application Flow

After successfully starting and then accessing ResumeMASTER using your favorite
browser, it's finally time to go about creating, editing, and downloading your
resume!

#### Account Creation

Start off your journey by creating an account to control your resumes with.
After creating an account, simply login to access the your dashboard.

##### Account Field Requirements

- Usernames must be alphanumeric, 1-15 chars in length
- Emails are checked against [RFC 822](https://datatracker.ietf.org/doc/html/rfc822)
- Passwords must:
  - be >= 8 chars
  - contain >= 1 lowercase letter
  - contain >= 1 uppercase letter
  - contain >= 1 digit

#### Resume Creation

Create a resume either entirely by yourself or by leveraging the power of
generative AI to level-up your resume!
Simply fill out the input fields as prompted and click "Create Resume" when your
through.

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

All it takes to upgrade your resume's fields is a simple button click!
Simply check the "Would you like AI to improve this?" box on the input fields
where it's available and Google's Gemini will aid you in expressing yourself to
potential employers.
You will have a chance to review and edit anything, including your own work,
before you download it so feel free to explore how you would like to present
yourself!

#### Manage Resumes

Once you have created a resume or two you will be able to view, edit, download,
and delete them as you see fit.
This functionality is available through a dashboard on your account.
You can view, edit, and download as much as you like, but deletion is permanent!
