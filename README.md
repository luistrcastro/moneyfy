Personal finance Web App

# Starting it locally

Our API service is completely separated from our Client service, so you will have to run commands separately, per the below:

- You will need Docker, either in WSL, Docker Desktop for Windows or any other OS of your choice
- Clone repo (of course haha)
- Copy .env.dev into .env (both in /api and /client)

### In /api:
  - run "make install" (We use Makefile, if unfamiliar check https://makefiletutorial.com/)
  - If you see any issues with missing vendor/autoload.php while running your app container, try running "composer install"
  - Run "php artisan key:generate"
 
 ### In /client:
  - run "bash install.sh" (if running in wsl, check what command you need to use to run the script). It will ask you for:
    - Project name: Moneyfy
    - Programming language: Typescript
    - Package manager: Yarn
    - UI framework: Vuetify.js
    - Template engine: HTML
    - Nuxt.js modules: AXIOS and PWA
    - Linting tools: ESLINT and Prettier
    - Testing framework: None (or your preference)
    - Rendering mode: Universal
    - Deployment target: Server
    - Development tools: Whatever you want
    - Continuous integration: None
    - Version control system: Git
  - Revert changes in package.json and nuxt.config
  - run "make app.bash" and then "yarn install"

...serveral moments later 🧽 (closest spongebob emogi I could find)

Open localhost:3000 in your browser 🎊


# This app uses optimus to hash ids

Check their repo for instructions if you want to use it https://github.com/cybercog/laravel-optimus/blob/master/README.md
Add hashes to /api/.env, check optimus.php and optimusRelationships.php for more info
