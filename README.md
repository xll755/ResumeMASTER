# ResumeMASTER

## About

## Install

ResumeMASTER is a web application that is deployed on Docker containers.
This means that running the application is as simple as fetching the source
code, building the contains, and accessing the application through your browser
of choice.

### Initial installation

```bash
# Clone repository & navigate to local directory
git clone https://github.com/xll755/ResumeMASTER.git
cd ~/ResumeMASTER

# Build & run the application
docker compose up --build
# Access the application locally
firefox localhost

# to stop containers
docker compose stop
# to stop and remove containers
docker compose down # This command will **DELETE** ANY DATA IN THE DATABASE
```

### Additional steps

ResumeMASTER employs the use of a `.env` file for managing secrets.
This file is **NOT** tracked by the repository due to its sensitive nature and
therefore must be created individually by each user as they see fit.

#### Add API key

```bash
# Create an ".env" file if you don't have one created already.
touch ./www/.env

# Place secrets inside
echo "API_KEY=<your_api_key>" > ./www/.env
```

> [!IMPORTANT]
> ResumeMASTER uses Google's genAI Gemini model for any genai improvements made
> to user input.
> This means that for this functionality to be accessible you must acquire and
> include an API key.

### Subsequent runs

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
```
