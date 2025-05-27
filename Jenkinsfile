pipeline {
    agent any

    environment {
        APP_ENV = "local"
        DB_CONNECTION = "mysql"
        DB_DATABASE = "laravel"
        DB_USERNAME = "laravel"
        DB_PASSWORD = "secret"
    }

    stages {
        stage('Checkout Code') {
            steps {
                git url: 'https://github.com/edowaado29/nhcare-deploy.git'
            }
        }

        stage('Install Dependencies') {
            steps {
                sh 'composer install --no-interaction --prefer-dist'
            }
        }

        stage('Copy .env') {
            steps {
                sh 'cp .env.example .env'
            }
        }

        stage('Generate App Key') {
            steps {
                sh 'php artisan key:generate'
            }
        }

        stage('Run Migrations') {
            steps {
                sh 'php artisan migrate'
            }
        }

        stage('Run Tests') {
            steps {
                sh 'php artisan test'
            }
        }
    }
}
