<?php
// funciones para interactuar con la tabla 'user'
require_once __DIR__ . '/connectaBD.php';

// función para registrar un nuevo usuario con seguridad
function registerUser(array $userData): bool
{
    // cifrado de la contraseña (password_hash)
    $hashedPassword = password_hash($userData['password'], PASSWORD_DEFAULT);
    if ($hashedPassword === false) {
        error_log("Error al hashear la contraseña.");
        return false;
    }

    $conn = connectaBD();
    
    // consulta de la inserción por parametros
    $sql = 'INSERT INTO "user" (name, email, password, address, city, zip_code) 
            VALUES ($1, $2, $3, $4, $5, $6)';
            
    // array de parámetros (consulta por parametros)
    // utilizamos el password hasheado
    $params = [
        $userData['name'],
        $userData['email'],
        $hashedPassword,
        $userData['address'] ?? null, // null si en las opcionales no se da nada
        $userData['city'] ?? null,
        $userData['zip_code'] ?? null
    ];
    
    $result = @pg_query_params($conn, $sql, $params);

    if (!$result) {
        // error email ya existe
        $error = pg_last_error($conn);
        error_log("Error al registrar usuario: " . $error);
        pg_close($conn);
        return false;
    }
    
    pg_close($conn);
    return true; // registro con exito
}

function validateUser($email, $password) {
    $conn = connectaBD();
    // buscamos el usuario por correo
    $sql = 'SELECT id, name, password FROM "user" WHERE email = $1';
    $result = pg_query_params($conn, $sql, [$email]);

    if ($result && pg_num_rows($result) > 0) {
        $user = pg_fetch_assoc($result);
        // verificamos el hash de la contraseña 
        if (password_verify($password, $user['password'])) {
            pg_close($conn);
            return $user; // retur de los datos del usuario
        }
    }
    pg_close($conn);
    return false;
}

function getUserById($id) {
    $conn = connectaBD();
    $sql = 'SELECT id, name, email, address, city, zip_code, image FROM "user" WHERE id = $1';
    $result = pg_query_params($conn, $sql, [$id]);
    $user = pg_fetch_assoc($result);
    pg_close($conn);
    return $user;
}

function updateUser($id, $name, $address, $city, $zip_code, $imageName = null) {
    $conn = connectaBD();
    
    if ($imageName) {
        $sql = 'UPDATE "user" SET name=$1, address=$2, city=$3, zip_code=$4, image=$5 WHERE id=$6';
        $params = [$name, $address, $city, $zip_code, $imageName, $id];
    } else {
        $sql = 'UPDATE "user" SET name=$1, address=$2, city=$3, zip_code=$4 WHERE id=$5';
        $params = [$name, $address, $city, $zip_code, $id];
    }
    
    $result = pg_query_params($conn, $sql, $params);
    pg_close($conn);
    return $result;
}

?>