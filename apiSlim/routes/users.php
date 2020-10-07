<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Get User 
 */
// create GET HTTP request
$app->get('/user', function(Request $request, Response $response) use($db){
    $id = $request->getParam("id") ?? 0;
    
    if($id == 0 ){
        $users = $db->users();
    } else {
        $users = $db->users()->where("id = ?", $id);
    }

    return $response->getBody()->write( json_encode( $users ) );
});

/**
 * POST User 
 */
// create POST HTTP request
$app->post('/user', function(Request $request, Response $response) use($db, $pdo){
    $result = $db->users()->insert(array(
        "active" => $request->getParam('active'),
        "name"   => $request->getParam('name'),
        "email"  => $request->getParam('email')
    ));

    return $response->getBody()->write( json_encode( array('id'=>$result['id']) ) );
});

/**
 * PUT User 
 */
// create PUT HTTP request
$app->put('/user/{id}', function(Request $request, Response $response) use($db){
    $id     = $request->getAttribute("id") ?? 0;
    $user   = $db->users()->where('id = ?', $id);
    if($user->fetch()){
        $result = $user->update(array(
            "active" => $request->getParam('active'),
            "name"   => $request->getParam('name'),
            "email"  => $request->getParam('email')
        ));
        
        $status  = (bool)$result;
        $message = 'User updated successfully';
    } else {
        $status  = false;
        $message = 'User id $id does not exist';
    }

    return $response->getBody()->write( json_encode( 
        array(
            'status'  => $status,
            'message' => $message)
    ));
});

/**
 * DELETE User 
 */
// create DELETE HTTP request
$app->delete('/user/{id}', function(Request $request, Response $response) use($db){
    $id     = $request->getAttribute("id") ?? 0;
    $user   = $db->users()->where("id", $id);
    
    if ($user->fetch()) {
        $result     = $user->delete();
        $status     = (bool)$result;
        $message    = 'User deleted successfully';
    } else {
        $status     = false;
        $message    = 'User id $id does not exist';
    }

    return $response->getBody()->write( json_encode( 
        array(
            'status'  => $status,
            'message' => $message)
    ));
});