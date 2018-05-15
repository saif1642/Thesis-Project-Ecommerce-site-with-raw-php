<?php 

session_start();
include "geo.php";


class auth
{
	private $username,$password,$email,$role,$phone,$location;
	private $dbuser='root';
	private $dbpass='';

	public function setdata($data){
		$this->username=$data['name'];
		$this->password=$data['pwd'];
		$this->email=$data['email'];
		$this->role=$data['role'];
		$this->phone=$data['phone'];
		$this->location=$data['location'];

		//print_r($this);

		return $this;


	}

	public function getusers()
	{

      		$pdo = new PDO('mysql:host=localhost;dbname=bkdb',$this->dbuser, $this->dbpass);

			$query="SELECT * FROM users";
			$stmt = $pdo->prepare($query);
			$stmt->execute();
			$userdata=$stmt->fetchall();

			return $userdata;
			

	}


	public function login($data)
	{
		     $user=$data['email'];
		     $password=md5($data['password']);
	
			$pdo = new PDO('mysql:host=localhost;dbname=bkdb',$this->dbuser, $this->dbpass);

			echo $query="SELECT * FROM users where  email='$user' and password='$password'";
			$stmt = $pdo->prepare($query);
			$stmt->execute();
			$userdata=$stmt->fetch(PDO::FETCH_ASSOC);

			if(!(empty($userdata)))
			{
				$_SESSION['loginuserinfo']=$userdata;
				$_SESSION['Loginsuccess']="success";
				header("location:index.php");

			}
			else
			{
				$_SESSION["Loginfailed"]="Re - enter your userifo / password!";
				header("location:index.php");

			}

            
			//return $userdata;
			

	}




	public function store(){

		try {

			
			$pdo = new PDO('mysql:host=localhost;dbname=bkdb',$this->dbuser, $this->dbpass);

			$query="INSERT INTO users(user_id,name,email,password,role,phone,location,join_date,ban_status,ban_time) values(:i,:u,:e,:p,:r,:phn,:loc,:jd,:ban,:bt)";
			$stmt = $pdo->prepare($query);

			
			$timezone="Asia/Dhaka";
            date_default_timezone_set($timezone);
            

			$data=array(
				':i' => null,
				':u' => $this->username,
				':e' => $this->email,
				':p' => md5($this->password),
				':r' =>($this->role),
				':phn' =>($this->phone),
				':loc' =>($this->location),
				':jd'=>date('y-m-d h:i:sa'),
				':ban' =>0,
				':bt'=>null
				);

			$status=$stmt->execute($data);
            

            if($status)
            {
            	$_SESSION["Message"]="Registration Successful";
                header('location:signup.php');
            }




			}
	    catch(PDOException $e) {
				echo 'Error: ' . $e->getMessage();

			}

        }

     

 public function time_elapsed($datetime, $full = false) 
 {          
 	$timezone="Asia/Dhaka";
    date_default_timezone_set($timezone);

    
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}







}

?>