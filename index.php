<?php
// En-têtes CORS (Cross-Origin Resource Sharing)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

// Gestion de la requête préliminaire (Preflight) CORS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require_once __DIR__ . '/config/Database.php';
require_once __DIR__ . '/controllers/ProductController.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$parts = explode('/', trim($uri, '/'));

// Servir la vue HTML à la racine du dossier
if (empty($parts[0]) || end($parts) === 'index.php' || end($parts) === 'api-crud-seance4') {
    include __DIR__ . '/views/index.html';
    exit;
}

// Servir les fichiers CSS statiques
if (preg_match('/\.css$/', $uri)) {
    header("Content-Type: text/css");
    readfile(__DIR__ . '/views/style.css');
    exit;
}

// Routage API REST : /api/products ou /api/products/{id}
$apiIndex = array_search('api', $parts);

if ($apiIndex !== false && isset($parts[$apiIndex + 1]) && $parts[$apiIndex + 1] === 'products') {
    $id = isset($parts[$apiIndex + 2]) && is_numeric($parts[$apiIndex + 2]) ? (int)$parts[$apiIndex + 2] : null;

    $database = new Database();
    $db = $database->getConnection();
    $controller = new ProductController($db);

    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            $controller->handleGet($id);
            break;
        case 'POST':
            $controller->handlePost();
            break;
        case 'PUT':
            $controller->handlePut($id);
            break;
        case 'DELETE':
            $controller->handleDelete($id);
            break;
        default:
            http_response_code(405);
            header("Allow: GET, POST, PUT, DELETE");
            echo json_encode(["message" => "Méthode non autorisée."]);
            break;
    }
    exit;
}

http_response_code(404);
echo json_encode(["message" => "Endpoint non trouvé."]);
