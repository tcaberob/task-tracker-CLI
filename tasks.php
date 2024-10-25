<?php

// Path of the JSON file where the tasks will be stored
$taskFile = 'tasks.json';

// Initialized the JSON file if it does not exists
if(!file_exists($taskFile )){
  file_put_contents($taskFile, json_encode([]));
}

// Function to get tasks from JSON file
function getTasks(){
  global $taskFile;
  $tasks = json_decode(file_get_contents($taskFile), true);
  return $tasks ? $tasks : [];
}

// Funtion for saving tasks to JSON file
function saveTask($tasks){
  global $taskFile;
  file_put_contents($taskFile, json_encode($tasks, JSON_PRETTY_PRINT));
}

// Funtion for adding a task
function addTask($title){
  $tasks = getTasks();
  $tasks[] = [
    'title' => $title,
    'status' => 'todo'  // todo, in-progress, done
  ];
  saveTask($tasks);
  echo "Task '$title' added successfully.\n";
}

// Funtion for delete a task
function deleteTask($index){
  $tasks = getTasks();
  if(isset($tasks[$index])){
    $title = $tasks[$index]['title'];
    array_splice($tasks, $index, 1);
    saveTask($tasks);
    echo "Task '$title' deleted successfully.\n";
  }else{
    echo "Task not found.\n";
  }
}

// Funtion for update a task title
function updateTaskTitle($index, $title){
  $tasks = getTasks();
  if(isset($tasks[$index])){
    $oldTitle = $tasks[$index]['title'];
    $tasks[$index]['title'] = $title;
    saveTask($tasks);
    echo "Task \"$oldTitle\" updated successfully to \"$title\".\n";
  }else{
    echo "Task not found.\n";
  }
}


// Update a task as in progress or done status
function updateTaskStatus($argStatus, $index){
  $tasks = getTasks();
  if (isset($tasks[$index])) {
    $status = ($argStatus == 'mark-done') ? 'done' : 'in-progress';
    $tasks[$index]['status'] = $status;
    saveTask($tasks);
    echo "Task {$tasks[$index]['title']} updated to '$status' status\n";
  } else {
    echo "Task not found.\n";
  }  
}

// List all tasks or filter by status
function listTasks($filter = null){
  $tasks = getTasks();
  if(empty($tasks)){
    echo "There are no tasks.\n";
    return;
  }
  $noPrinList  = true;
  foreach ($tasks as $index => $task) {
    if ($filter === null ||  $task['status'] == $filter) {
      echo "[" . ($index + 1) . "]" . $task['title'] . " - " . $task['status'] . "\n";
      $noPrinList = false;
    }
  }
  if ($noPrinList) {
    echo "0 Task $filter\n";
  }
}

// Process CLI commands
$action = $argv[1] ?? null;

switch ($action) {
  case 'add':
    $title = $argv[2] ?? null;
    if ($title) {
      addTask($title);
    } else {
      echo "Please provide a title for the Task.\n";
    }
    break;

  case 'update':
    $index = ($argv[2] ?? 0) - 1; // Convert to 0-based index
    $title = $argv[3] ?? null;
    updateTaskTitle($index, $title);    
    break;

  case 'delete':
    $index = ($argv[2] ?? 0) -1; // Convert to 0-based index
    deleteTask($index);
    break;

  case 'mark-in-progress':
    $index = ($argv[2] ?? 0) - 1;
    updateTaskStatus($action, $index);
    break;

  case 'mark-done':
    $index = ($argv[2] ?? 0) - 1;
    updateTaskStatus($action, $index);
    break;

  case 'list':
    $filter = $argv[2] ?? null;
    if (isset($filter) &&  !in_array($filter, ['done', 'todo', 'in-progress'])) {
      echo 'Incorrect status argument only this status list is allowed [\'todo\', \'in-progress\', \'done\']'. "\n";
    }else {
      listTasks($filter);
    }
    break;
  
  default:
    echo "Invalid command or argument $action\n\n";
    echo "Allowed commands [arg1][arg2][arg3]\n\n";
    echo "Commands as argument 1: [arg1]";
    echo "\nadd \nupdate \nmark-in-progress \nmark-done \nlist \ndelete\n\n";
    echo "Commands as arguments 2 example cases:\n";
    echo "[add] [arg2]    arg2 = string(Title task)\n";
    echo "[update] [arg2] [arg3]   arg2 = int(index)  arg3 = string(New Title)\n\n";
    echo "[mark-in-progress] [arg2]   arg2 = int(index)\n";
    echo "[mark-done] [arg2]\n\n";
    echo "[list] [arg2]   arg2 = opcion filter('null', 'todo', 'in progress', 'done')\n";
    echo "[delete] [arg2]   arg = int(index)\n";
}