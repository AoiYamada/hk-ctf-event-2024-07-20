<?php
	/* 用户相关函数 */

	require_once 'sql.php';

	$USERNAME = '';

	$FORCESTATUS = 0;

    function getNote($username){
        global $conn;
		if(!checkUsername($username)) return -1;
        
        $stmt = $conn->prepare("SELECT note FROM note_users WHERE username = ?");
        $stmt->execute(array($username));
        $result = $stmt->fetch();
        
        return $result['note'];
        
    }

    function changeNote($username, $newnote){
        global $conn;
		if(!checkUsername($username)) return -1;

        $stmt = $conn->prepare("UPDATE note_users SET note = ? WHERE username = ?");
        $stmt->execute(array($newnote, $username));
    }
    
	function hasUser($username){
		global $conn;
		if(!checkUsername($username)) return -1;
        
        $stmt = $conn->prepare("SELECT username FROM note_users WHERE username = ?");
        $stmt->execute(array($username));
            
		if( $stmt->rowCount() > 0 ){
			return true;
		}
		return false;
	}

	function hasLogin(){
		global $conn, $USERNAME, $FORCESTATUS;

		if($FORCESTATUS == 1) return true;
		if($FORCESTATUS == 2) return false;

		if(!isset($_COOKIE['MarkNoteUser']) || !isset($_COOKIE['MarkNotePasswd']))
			return false;

		$username = $_COOKIE['MarkNoteUser'];
		if(!checkUsername($username)) return -1;
        
        $stmt = $conn->prepare("SELECT passwd FROM note_users WHERE username = ?");
        $stmt->execute(array($username));

            
		if( $stmt->rowCount() > 0 ){
			$truePasswd = $stmt->fetch()['passwd'];
		}else{
			return false;
		}

		if( $truePasswd == $_COOKIE['MarkNotePasswd'] ){
            $stmt = $conn->prepare("SELECT username FROM note_users WHERE username = ?");
            $stmt->execute(array($username));
            
			$username = $stmt->fetch()['username'];
			$USERNAME = $username;
			return true;
		}else{
			return false;
		}

	}

	function register($username, $passwd, $nickname){
		global $conn;
		if(!checkUsername($username)) { exit('username format is wrong,please register again'); return -1;}
		if(!checkTitle($nickname)) return -1;
  if(!checkPassword($passwd)) { exit('password format is wrong,please register again');return -1;}

		if( hasUser($username) )
			exit('Username already exist');
		$passwd = md5('gamegame'.$passwd.'gamegame');
		$note='### RSA
RSA (Rivest–Shamir–Adleman) is a public-key cryptosystem, one of the oldest widely used for secure data transmission. The initialism "RSA" comes from the surnames of Ron Rivest, Adi Shamir and Leonard Adleman, who publicly described the algorithm in 1977. An equivalent system was developed secretly in 1973 at Government Communications Headquarters (GCHQ), the British signals intelligence agency, by the English mathematician Clifford Cocks. That system was declassified in 1997.

### Key distribution
Suppose that Bob wants to send information to Alice. If they decide to use RSA, Bob must know Alice\'s public key to encrypt the message, and Alice must use her private key to decrypt the message.

To enable Bob to send his encrypted messages, Alice transmits her public key (n, e) to Bob via a reliable, but not necessarily secret, route. Alice\'s private key (d) is never distributed.

### Encryption
![1](statics/rsa01.png)

### Decryption
![2](statics/rsa02.png)

';
        $nick = '{\"nickname\" = \"' . $nickname . '\" }';
        
        $stmt = $conn->prepare("INSERT INTO note_users (username, passwd, note, settings) VALUES (?, ?, ?, ?)");
        $stmt->execute(array($username, $passwd, $note, $nick));
	}

	function login($username, $passwd){
		global $conn, $USERNAME, $FORCESTATUS;
		if(!checkUsername($username)) {echo "username or password is wrong";return -1;}

        $stmt = $conn->prepare("SELECT passwd FROM note_users WHERE username = ?");
        $stmt->execute(array($username));

            
		if( $stmt->rowCount() > 0 ){
			$truePasswd = $stmt->fetch()['passwd'];
		}else{
			echo "username or password is wrong"; //no user
			return -1;
		}
		if(md5('gamegame'.$passwd.'gamegame') == $truePasswd){
            
            $stmt = $conn->prepare("SELECT username FROM note_users WHERE username = ?");
            $stmt->execute(array($username));
            $username = $stmt->fetch()['username'];
			
            
			setcookie('MarkNoteUser', $username, time()+604800);
			setcookie('MarkNotePasswd', md5('gamegame'.$passwd.'gamegame'), time()+604800);
			$USERNAME = $username;
			$FORCESTATUS = 1;
			return 0;
		}else{
			echo "username or password is wrong";
			return -1;
		}
	}


	function logout(){
		global $FORCESTATUS;
		setcookie('MarkNoteUser', '', time()-100);
		setcookie('MarkNotePasswd', '', time()-100);
		$FORCESTATUS = 2;
	}