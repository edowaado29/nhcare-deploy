pipeline {
    agent any

    environment {
        APP_ENV = "local"
        DB_CONNECTION = "mysql"
        DB_HOST = "db"
        DB_PORT = "3306"
        DB_DATABASE = "laravel"
        DB_USERNAME = "laravel"
        DB_PASSWORD = "secret"
    }

    stages {
        stage('Clone Repo') {
            steps {
                git url: 'https://github.com/edowaado29/nhcare-deploy.git', branch: 'main'
            }
        }

        stage('Prepare Environment') {
            steps {
                sh 'cp .env.example .env'
                sh 'composer install'
                sh 'php artisan key:generate'
            }
        }

        stage('Migrate Database') {
            steps {
                sh 'php artisan migrate --force'
            }
        }

        stage('Run Tests') {
            steps {
                sh 'php artisan test'
            }
        }

        stage('Build & Deploy') {
            steps {
                echo 'Deploy...'
            }
        }
    }

    post {
        success {
            echo '✅ Build & test success!'
        }
        failure {
            echo '❌ Build failed!'
        }
    }
}
