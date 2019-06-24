# docker-seminar



## Useful docker command

```sh
# List Docker CLI commands
$ docker
$ docker container --help

# Display Docker version and info
$ docker --version
$ docker version
$ docker info

# Pull and Run Docker image
$ docker pull hello-world										# Pull "helloworld" image from repo
$ docker run hello-world										# Run "helloworld"
$ docker run -p 4000:80 helloworld          # Run "helloworld" mapping port 4000 to 80
$ docker run -d -p 4000:80 helloworld       # Same thing, but in detached mode
$ docker run -v `pwd`:/src helloworld       # Same thing, with volumn

# List Docker containers
$ docker ps																	# running
$ docker ps -a  														# all
$ docker ps -q  														# running in quiet mode
$ docker ps -aq															# all in quiet mode

# Build from Dockerfile
$ docker build -t helloworld .              # Create image using this directory's Dockerfile

# Run a command in a running container
$ docker exec -it <name> bash

# Running containers
$ docker stop <hash> | <name>               # Gracefully stop the specified container
$ docker stop $(docker ps -a -q)            # Stop all running containers
$ docker kill <hash> | <name>               # Force shutdown of the specified container
$ docker kill $(docker ps -a -q)            # Kill all running containers
$ docker rm <hash> | <name>                 # Remove specified container from this machine
$ docker rm $(docker ps -a -q) 							# Remove all containers

# List Docker images
$ docker images															# List all images on this machine
$ docker rmi <image id>											# Remove specified image from this machine
$ docker rmi $(docker images -q) 			 			# Remove all images from this machine

# Invididual docker hub
$ docker login                              # Log in CLI session using your account
$ docker tag <image> username/repo:tag      # Tag <image> for upload to registry
$ docker push username/repository:tag       # Upload tagged image to registry
$ docker run username/repository:tag        # Run image from a registry
```



## Useful docker-compose command

```shell
$ docker-compose up								# Builds, (re)creates, starts, and attaches to containers
$ docker-compose up --build				# Build and up
$ docker-compose up -d						# Up in background
$ docker-compose down							# Stops and removes containers created by up

$ docker-compose ps								# Lists containers
$ docker-compose ps -q						# Only display IDs

$ docker-compose start						# Starts existing containers
$ docker-compose stop							# Stops running containers without removing them
$ docker-compose kill							# Forces running containers to stop

$ docker-compose top							# Displays the running processes.
```



## Dockerfile

```
- FROM: Define the base image used to start the build process
- MAINTAINER: Define the full name and email address of the image creator
- ENV: Set environment variables
- USER: Set the UID (the username) that will run the container

- RUN: Central executing directive for Dockerfiles
- ADD: Copy files from a source on the host to the container

- WORKDIR: Set the path where the command, defined with CMD, is to be executed
- VOLUME: Enable access from the container to a directory on the host machine
- EXPOSE: Expose a specific port to enable networking between the container and the outside

- CMD: Execute a specific command within the container
- ENTRYPOINT: Set a default app to be used every time a container is created with the image
```



## docker-compose.yml

```yaml
# docker-compose.yml
version: '3'

services:
  web:
    build: .
    # build from Dockerfile
    context: ./Path
    dockerfile: Dockerfile
    ports:
     - "3000:3000"
    volumes:
     - .:/code
  redis:
    image: redis
```

```yaml
web:
  # build from Dockerfile
  build: .
  # build from custom Dockerfile
  build:
    context: ./dir
    dockerfile: Dockerfile.dev
  # build from image
  image: ubuntu
  image: ubuntu:14.04
  image: tutum/influxdb
  image: example-registry:4000/postgresql
  image: a4bc65fd
  
  
  # port
  ports:
    - "3000"
    - "8000:80"  # host:container
  expose: ["3000"]	# expose ports to linked services (not to host)
  
  
  # environment vars
  environment:
    RACK_ENV: development
  environment:
    - RACK_ENV=development
    
  # command to execute
  command: bundle exec thin -p 3000
  command: [bundle, exec, thin, -p, 3000]
  
  # override the entrypoint
  entrypoint: /app/start.sh
  entrypoint: [php, -d, vendor/bin/phpunit]
  
```

