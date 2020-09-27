# product-listing-challenge

A simple API backend that consumes Iconic's product API and decorates results with video preview links. Results that contain video previews should also be preferenced to the top of the results in the UI. The backend of this application is built using Laravel v8.0 and the frontend is built using React.js v16.13.1.

### Demo

![DemoGif](demo.gif?raw=true "Gif")

## API Server (Laravel Backend)

- Consists of two APIs:

  - `[GET]` `/products` (`gender`, `page` and `page_size` as required parameters)
    - Returns a catalog having a list of products
  - `[GET]` `/products/{product_id}/videos` (`product_id` is the required path parameter)
    - Returns the video url for the given product id
  - Consists of one Unit test and multiple API tests

## Client (React Frontend)

- Display a list of produts with name, brand and prices
- Provides the functionality to navigate between pages
- Provides the functionality to sort based on gender, page size
- **All the products having video preview will be displayed first by default (Product having the video preview is indicated with an icon on the bottom right of the tile which can then be clicked to view the product video)**
- Support all the modern browsers

## Getting Started

The code assumes you have Docker running on your machine. If you do not, they offer easy to install binaries ([Mac](https://docs.docker.com/docker-for-mac/install/)) ([Windows](https://docs.docker.com/docker-for-windows/install/)).

- Clone this repository
- Make sure you don't have anything running on port `8100`
- From the root of this project, run `sudo chmod +x ./run-application.sh` which will make `./run-application.sh` script executable
- Now run `./run-application.sh` which will take a while (can take upto 10 mins) as it will setup everything for you and run the php fpm service and nginx both. It will perform the following steps:
  - Build the docker containers needed for this application to run in the local environment
  - Install all the dependencies using composer and npm
  - Copy env.example file as .env and generate laravel app key
  - After building the containers, it will start the containers
  - At the end it will run all the Laravel tests as well
- After the containers are up. Navigate to `localhost:8100` and see the application in action.

### Project Built Using

- git
- NPM
- Laravel v8.0
- React v16.13.1
- Docker v19.03.8

### Acknowledgements

- [Docker](https://docs.docker.com/)
- [Laravel](https://laravel.com/docs/8.x)
- [React Documentation](https://reactjs.org/docs/getting-started.html)
- [W3Schools](https://www.w3schools.com/)
- [Stack Overflow](https://stackoverflow.com/)
