<?php 

function getPosts ($pdo) {
    $stmt = $pdo ->prepare("SELECT * FROM posts"); 
    $stmt -> execute();
    $posts = $stmt -> fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($posts);
}

function getPost ($pdo, $id){
    $stmt = $pdo ->prepare("SELECT * FROM posts WHERE id = :id");
    $stmt -> bindParam(':id', $id);
    $stmt -> execute();
    if ($stmt->rowCount() === 1) {
        $post = $stmt -> fetch(PDO::FETCH_ASSOC);
        echo json_encode($post);
    } else {
        $response = [
            'status' => false,
            'message' => 'Post not found'
        ];
    echo json_encode($response);
    }
}

function addPost ($pdo, $data, $id) {
    $data = [
    ':title' => $_POST['title'],
    ':body' => $_POST['body']
    ];
    $stmt = $pdo ->prepare("INSERT INTO `posts`(`title`, `body`) VALUES (:title, :body)");
    $stmt -> execute($data);
    $id = $pdo ->lastInsertId();
    
    if (isset($id) === true) {
        $response = [
            'status' => true,
            'message' => 'Created!',
            'post_id' => $id,
            'new_post' => $data];
    } else {
            $response = [
        'status' => false,
        'message' => 'Error! Bad request'];
    }
    echo json_encode($response);
    
}

function deletePost($pdo, $id) {
    $stmt = $pdo ->prepare("DELETE FROM posts WHERE id = :id");
    $stmt -> bindParam(':id', $id);
    $stmt -> execute();
        if (isset($id) === true) {
        $response = [
            'status' => true,
            'message' => 'Delete!'];
    } else {
            $response = [
        'status' => false,
        'message' => 'Error! Bad request'];
    }
    echo json_encode($response);
}

function updatePost($pdo, $data, $id) {
    $stmt = $pdo -> prepare("UPDATE `posts` SET title = :title, body = :body WHERE `id` = :id");
    $stmt -> execute(['title' => $data['title'], 'body' => $data['body'], 'id' => $id]);
    http_response_code(200);
    $response = [
        'status' => true,
        'message' => 'Modified!'];
    echo json_encode($response);
}