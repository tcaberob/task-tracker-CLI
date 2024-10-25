# Task Traker CLI with PHP

Backend Projects, run a ToDo using CLI [Link](https://roadmap.sh/projects/task-tracker)

Task Tracker CLI is a command-line application that allows you to easily manage tasks. You can add, update, list, and delete tasks directly from the console.

## Example
```bash
# Adding a new task
php task.php add "Buy groceries"
# Output: Task added successfully

# Updating and deleting tasks
php task.php update 1 "Buy groceries and cook dinner"
php task.php delete 1

# Marking a task as in progress or done
php task.php mark-in-progress 1
php task.php mark-done 1

# Listing all tasks
php task.php list

# Listing tasks by status
php task.php list done
php task.php list todo
php task.php list in-progress
```
## Requirements

- PHP 7.4 or higher 
- Windows, Linux or macOS operating system 
- Command terminal (cmd, PowerShell, bash, etc.)

## Installation

1. Clone the repository to your local machine:
    ```sh
    git clone https://github.com/tu-usuario/task-traker-CLI.git
    ```

2. Navigate to the project directory:
    ```sh
    cd task-traker-CLI
    ```

3. Make sure you have PHP installed and configured in your PATH.

## Uso

Para ejecutar la aplicación, abre tu terminal y navega al directorio del proyecto. Luego, ejecuta el siguiente comando:

```sh
php [tasks.php](http://_vscodecontentref_/#%7B%22uri%22%3A%7B%22%24mid%22%3A1%2C%22fsPath%22%3A%22c%3A%5C%5Claragon%5C%5Cwww%5C%5Croadmap_practice%5C%5Cbackend%5C%5Ctask-traker-CLI%5C%5Ctasks.php%22%2C%22_sep%22%3A1%2C%22path%22%3A%22%2Fc%3A%2Flaragon%2Fwww%2Froadmap_practice%2Fbackend%2Ftask-traker-CLI%2Ftasks.php%22%2C%22scheme%22%3A%22file%22%7D%7D) [comando] [argumentos]