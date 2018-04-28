# Static HTML to WP Source Code - Module 7 - Brkstn Bedrock WordPress

> The source code for module one of the blog building guide found [here](https://steven-klein.github.io/blog-guide/7-brkstn-bedrock-wordpress/).

## Devlopment

```shell
#clone
$ git clone  git@github.com:steven-klein/blog-demo.git source.test

#cd into new directory
$ cd source.test

#run composer install
$ composer install

#copy the environment
$ cp .env.example .env

#install node_modules
$ yarn

#Build
$ npm run build

```

## Deployment

```shell
#builds and deploys for production
$ npm run deploy:prod

#builds and deploys for dev/staging
$ npm run deploy:dev
```

## Bedrock

For additional information on working with this customized WordPress structure, please see [Bedrock](https://roots.io/bedrock/), which this project was sourced from.
