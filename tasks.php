<?php

// Path of the JSON file where the tasks will be stored
$taskFile = 'tasks.json';

// Initialize the JSON file if it does not exist
if (!file_exists($taskFile)) {
    file_put_contents($taskFile, json_encode([]));
}

// Function to get tasks from JSON file
function getTasks()
{
    global $taskFile;
    $tasks = json_decode(file_get_contents($taskFile), true);
    return $tasks ? $tasks : [];
}

// Function for saving tasks to JSON file
function saveTask($tasks)
{
    global $taskFile;
    file_put_contents($taskFile, json_encode($tasks, JSON_PRETTY_PRINT));
}

// Function for adding a task
function addTask($description)
{
    $tasks = getTasks();
    $id = count($tasks) + 1;
    $now = date('j-n-Y g:i:s a');
    $tasks[] = [
        'id' => $id,
        'description' => $description,
        'status' => 'todo',  // todo, in-progress, done
        'createdAt' => $now,
        'updatedAt' => $now
    ];
    saveTask($tasks);
    echo "Task '$description' added successfully (ID: $id).\n";
}

// Function for deleting a task
function deleteTask($index)
{
    $tasks = getTasks();
    if (isset($tasks[$index])) {
        $description = $tasks[$index]['description'];
        unset($tasks[$index]);
        $tasks = array_values($tasks);
        saveTask($tasks);
        echo "Task '$description' deleted successfully.\n";
    } else {
        echo "Task not found.\n";
    }
}

// Function for updating a task title
function updateTaskTitle($index, $newDescription)
{
    $tasks = getTasks();
    if (isset($tasks[$index])) {
        $tasks[$index]['description'] = $newDescription;
        $tasks[$index]['updatedAt'] = date('j-n-Y g:i:s a');
        saveTask($tasks);
        echo "Task updated successfully.\n";
    } else {
        echo "Task not found.\n";
    }
}

// Function for updating a task status
function updateTaskStatus($status, $index)
{
    $tasks = getTasks();
    if (isset($tasks[$index])) {
        $tasks[$index]['status'] = $status;
        $tasks[$index]['updatedAt'] = date('j-n-Y g:i:s a');
        saveTask($tasks);
        echo "Task {$tasks[$index]['description']} status updated to '$status' successfully.\n";
    } else {
        echo "Task not found.\n";
    }
}

// Function for listing tasks
function listTasks($filter = null)
{
    $tasks = getTasks();
    if(empty($tasks)){
      echo "There are no tasks.\n";
      return;
    }
    $noPrinList  = true;
    foreach ($tasks as $index => $task) {
        if ($filter === null || $task['status'] === $filter) {
            echo "ID: {$task['id']}, Description: {$task['description']}, Status: {$task['status']}, Created At: {$task['createdAt']}, Updated At: {$task['updatedAt']}\n";
            $noPrinList = false;
        }
    }
    if ($noPrinList) {
      echo "0 Task $filter\n";
    }
}

// Main script logic
$action = $argv[1] ?? null;

switch ($action) {
    case 'add':
        $description = $argv[2] ?? null;
        if ($description) {
            addTask($description);
        } else {
            echo "Description is required.\n";
        }
        break;
    case 'update':
        $index = ($argv[2] ?? 0) - 1; // Convert to 0-based index
        $newDescription = $argv[3] ?? null;
        if ($newDescription) {
            updateTaskTitle($index, $newDescription);
        } else {
            echo "New description is required.\n";
        }
        break;
    case 'delete':
        $index = ($argv[2] ?? 0) - 1; // Convert to 0-based index
        deleteTask($index);
        break;
    case 'mark-in-progress':
        $index = ($argv[2] ?? 0) - 1;
        updateTaskStatus('in-progress', $index);
        break;
    case 'mark-done':
        $index = ($argv[2] ?? 0) - 1;
        updateTaskStatus('done', $index);
        break;
    case 'list':
        $filter = $argv[2] ?? null;
        if (isset($filter) && !in_array($filter, ['done', 'todo', 'in-progress'])) {
            echo "Incorrect status argument. Only these statuses are allowed: ['todo', 'in-progress', 'done'].\n";
        } else {
            listTasks($filter);
        }
        break;
    default:
        echo "Invalid command or argument $action\n\n";
        echo "Allowed commands [arg1][arg2][arg3]\n\n";
        echo "Commands as argument 1: [arg1]";
        echo "\nadd \nupdate \nmark-in-progress \nmark-done \nlist \ndelete\n\n";
        echo "Commands as arguments 2 example cases:\n";
        echo "[add] [arg2]    arg2 = string(Description task)\n";
        echo "[update] [arg2] [arg3]   arg2 = int(index)  arg3 = string(New Description)\n\n";
        echo "[mark-in-progress] [arg2]   arg2 = int(index)\n";
        echo "[mark-done] [arg2]\n\n";
        echo "[list] [arg2]   arg2 = option filter('null', 'todo', 'in-progress', 'done')\n";
        echo "[delete] [arg2]   arg2 = int(index)\n";
}