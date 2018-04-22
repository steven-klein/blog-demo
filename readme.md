# Blog Demo - Module 5 - Asset Bundling With Live Reload

> The source code for module one of the blog building guide found [here](https://steven-klein.github.io/blog-guide/5-asset-bundling-live-reload/).

## Live Development

Use Yarn to install all necessary node modules to do development work on this project.

```sh
# Install modules with Yarn
$ yarn install

# Start development with Browsersync
$ yarn run dev
```

## Development Bundles

Bundle without optimizations, better for debugging.

```sh
# bundle for development
$ yarn run build
```

## Produciton Bundles

Bundle this project with production optimizations.

```sh
# bundle with optimizations.
$ yarn run build:prod
```
