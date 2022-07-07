# Scoro Home Assignment

by Pavels Ivanovs

## Prerequisites
- Docker and Docker Compose

## Setup Guide
1. Get the repo locally: `git clone https://github.com/pavelsivanovs/scoro-ha`
2. Copy `.env.example` file to `.env` and set:
   - Scoro API key
   - Scoro Company ID
   - Scoro site URL
3. Run `docker-compose up` and wait till you see these messages in logs:
   - `lumen  | [...] PHP 7.4.30 Development Server (http://lumen:8000) started`
   - `vite   |   ready in XXXms.`
4. Go to [http://localhost:3000](http://localhost:3000). NB: the first render may be longer than usual.
