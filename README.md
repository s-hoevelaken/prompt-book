# prompt-book

![GitHub Workflow Status](https://img.shields.io/github/actions/workflow/status/elegantweb/sanitizer/test.yml?style=flat-square)
![GitHub](https://img.shields.io/github/license/elegantweb/sanitizer?style=flat-square)


This is a project used to elaborate for a portfolio. It is a simple online social platform that uses docker to run the application for anyone, withtout running into potential issues. </br>


### _Tech stack & files_

![Laravel](https://img.shields.io/badge/Laravel-3776AB?style=for-the-badge&labelColor=white&logo=laravel&logoColor=red&color=red)
![Livewire](https://img.shields.io/badge/Livewire-3776AB?style=for-the-badge&labelColor=black&logo=laravel&logoColor=fuchsia&color=fuchsia)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&labelColor=white&logo=php&logoColor=violet&color=purple)
![HTML](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![Javascript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&labelColor=black&logo=javascript&logoColor=yellow&color=yellow)
![Docker](https://img.shields.io/badge/Docker-2496ED?style=for-the-badge&labelColor=white&logo=docker&logoColor=lightblue&color=lightblue)

📁 **`src/`**: This folder contains all code written <br />
    - 📁 **`tests/`**: This folder contains the testcase docs and testfiles </br>
    - 📁 **`docker/`**: This folder contains docker configuration files to handle the server

📁 **`docs/`**: Contains documentation for the project <br />

</br>

## Instructions

1. **Clone the repository**:

    ```bash
    git clone https://github.com/s-hoevelaken/prompt-book.git
    ```
</br>

2. **Navigate to the 📁 **`src/`** and run the following command:**
    
    ```bash
    composer update

    docker-compose up
    ```
</br>

3. **Run the following commands to start the application**

    ```bash
    npm install
    php artisan migrate
    php artisan serve
    ```

</br>

## Usage

Be sure to have docker installed on your machine. If not, you can download it [here](https://www.docker.com/products/docker-desktop)

Make sure that your database is configured in the `.env` file and that your test run smoothly (look up test instructions).

### run tests cases

```bash
    php artisan test --testsuite=custom-tests
```


### Result:

![test operations](/promptbook/tests/docs/test_operations.png)


</br>

After you have finished the above steps, you can now access the application on your browser by visiting `http://localhost:8000`:

<img src="/storage/assets/images/homepage.png" alt="homepage" width="100%"/>
