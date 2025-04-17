<?php
	if(strpos($_SERVER['HTTP_HOST'],"localhost") === false)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') 
        {
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
            header('Access-Control-Allow-Headers: token, Content-Type, Authorization');
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 1728000');
            header('Content-Length: 0');
            header('Content-Type: application/json');
            die();
        }

        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
        // header('Access-Control-Allow-Headers: *');
        // header('Access-Control-Allow-Credentials: true');
        // header('Access-Control-Max-Age: 1728000');
        // header('Content-Length: 0');
    }   
	
    class Route 
    {
        /*
        two parameters.

        route : route address
        file : location of the file to show if route address matched

        */
        public function simpleRoute($route, $file)
        {            
            //replacing first and last forward slashes
            //$_REQUEST['uri'] will be empty if req uri is /
            if(!empty($_REQUEST['uri']))
            {
                $route = preg_replace("/(^\/)|(\/$)/","",$route);
                $reqUri =  preg_replace("/(^\/)|(\/$)/","",$_REQUEST['uri']);
            }
            else
            {
                $reqUri = "/";
            }
            if($reqUri == $route)
            {
                //on match include the file.
                include($file);

                //exit because route address matched.
                exit();
            }
        }

        public function add($route,$file)
        {
            //will store all the parameters value in this array
            $params = [];
            //will store all the parameters names in this array
            $paramKey = [];    
            //finding if there is any {?} parameter in $route
            preg_match_all("/(?<={).+?(?=})/", $route, $paramMatches);

            //if the $route does not contain any param call simpleRoute();
            if(empty($paramMatches[0]))
            {
                $this->simpleRoute($file,$route);
                return;
            }
    
            //setting parameters names
            foreach($paramMatches[0] as $key)
            {
                $paramKey[] = $key;
            }    
            
            //replacing first and last forward slashes
            //$_REQUEST['uri'] will be empty if req uri is /
    
            if(!empty($_REQUEST['uri']))
            {
                $route = preg_replace("/(^\/)|(\/$)/","",$route);
                $reqUri =  preg_replace("/(^\/)|(\/$)/","",$_REQUEST['uri']);
            }
            else
            {
                $reqUri = "/";
            }
            //exploding route address
            $uri = explode("/", $route);
            //will store index number where {?} parameter is required in the $route 
            $indexNum = []; 
    
            //storing index number, where {?} parameter is required with the help of regex
            foreach($uri as $index => $param)
            {
                if(preg_match("/{.*}/", $param))
                {
                    $indexNum[] = $index;
                }
            }
    
            //exploding request uri string to array to get
            //the exact index number value of parameter from $_REQUEST['uri']
            $reqUri = explode("/", $reqUri);
    
            //running for each loop to set the exact index number with reg expression
            //this will help in matching route
            foreach($indexNum as $key => $index)
            {    
                //in case if req uri with param index is empty then return
                //because url is not valid for this route
                if(empty($reqUri[$index]))
                {
                    return;
                }    
                //setting params with params names
                $params[$paramKey[$key]] = $reqUri[$index];    
                //this is to create a regex for comparing route address
                $reqUri[$index] = "{.*}";
            }    
            //converting array to sting
            $reqUri = implode("/",$reqUri);
    
            //replace all / with \/ for reg expression
            //regex to match route is ready !
            $reqUri = str_replace("/", '\\/', $reqUri);
    
            //now matching route with regex
            if(preg_match("/$reqUri/", $route))
            {
                include($file);
                exit();    
            }
        }

        public function notFound($file)
        {
            include($file);
            exit();
        }
    }
	$_SESSION["DocRoot"] = "http://localhost/helpdesk/";
    $_SESSION["ApiRoot"] = "http://localhost/helpdeskApi/";
    //Route instance
    $route = new Route();
    //route address and home.php file location
	//////Cron Page
	$route->simpleRoute("/","login.php");
	$route->simpleRoute("/login","login.php");
	$route->simpleRoute("/Dashboard","dashboard.php");
	$route->simpleRoute("/Customer","customer_list.php");
	$route->simpleRoute("/Agents","agents_list.php");
	$route->simpleRoute("/ProductSection","customer_product.php");
	$route->simpleRoute("/Services","services_list.php");
    $route->add("/Tickets/{Id}?{Code}?{status}", "tickets.php");  // '?' makes the Id optional
	$route->simpleRoute("/TicketSetting","ticket_setting.php");
	$route->simpleRoute("/TikcketInformation","ticket_Information.php");
	$route->simpleRoute("/Profile","profile.php");
	// $route->simpleRoute("/Product","product_list.php");
    //ticket_ui
	$route->simpleRoute("/RaiseTicket","ticket_ui/raise_ticket.php");
	$route->simpleRoute("/EditTicket","ticket_ui/edit_ticket.php");
    //customer_ui
	$route->simpleRoute("/CustomerDashboard","customer_ui/customer_dashboard.php");
    $route->add("/Ticketlist/{Id}?{status}","customer_ui/tickets.php");
	$route->simpleRoute("/TikcketInfo","customer_ui/tikcket_Information.php");
	$route->simpleRoute("/MyProducts","customer_ui/customer_products.php");
	$route->simpleRoute("/MyServices","customer_ui/customer_service.php");
	$route->simpleRoute("/MyProfile","customer_ui/customer_profile.php");
	$route->simpleRoute("/User","customer_ui/customer_user.php");
	$route->add("/CloseTicket/{otp}/{id}/{password}","customer_ui/close_ticket.php");
    //agent-ui
	$route->simpleRoute("/AgentDashboard","agent_ui/agent_dashboard.php");
    $route->add("/AgentTickets/{Id}?{status}","agent_ui/tickets.php");
	$route->simpleRoute("/TikcketDetails","agent_ui/tikcket_Information.php");
	$route->simpleRoute("/ProfileSection","agent_ui/agent_profile.php");
	$route->simpleRoute("/ChangePassword","change_password.php");
    $route->simpleRoute("/UserDashboard","customer_ui/customerUser_dashboard.php");
    $route->add("/UserTicket/{Id}?{status}","customer_ui/Customeruser_tickets.php");
    $route->add("/verification/{otp}/{id}/{password}","validate_captcha.php");
    $route->simpleRoute("/confirmation","customer_ui/confirmation_page.php");
   
    //write it at the last
    //arg is 404 file location
    $route->notFound("404.php");
?>