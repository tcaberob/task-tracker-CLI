# Task Tracker CLI with PHP

Backend Projects, run a ToDo using CLI [Link](https://roadmap.sh/projects/task-tracker)

Task Tracker CLI is a command-line application that allows you to easily manage tasks. You can add, update, list, and delete tasks directly from the console.

## Task Properties
Each task should have the following properties:
- `id`: A unique identifier for the task
- `description`: A short description of the task
- `status`: The status of the task (todo, in-progress, done)
- `createdAt`: The date and time when the task was created
- `updatedAt`: The date and time when the task was last updated

## Commands
- `add` `[description]`: Adds a new task with the specified description.
- `update` `[index]` `[description]`: Updates the description of the task at the specified index.
- `mark-in-progress` `[index]`: Marks the task at the specified index as "in-progress".
- `mark-done` `[index]`: Marks the task at the specified index as "done".
- `list` `[filter]`: Lists all tasks or filters by status (`todo`, `in-progress`, `done`).
- `delete` `[index]`: Deletes the task at the specified index.


## Example
```sh
# Adding a new task
php task.php add "Buy groceries"
# Output: Task added successfully (ID:1).

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

## Explanation
- JSON file: A `tasks.json` file is used to store tasks persistently.
- Errors and edge cases: The script handles missing arguments or invalid indexes to avoid unhandled errors.