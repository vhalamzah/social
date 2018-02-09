<?php

namespace App\Traits;

use App\friendship;
      
      trait Friendable
      {
        public function test()
         {
            return 'Hello world!!!';
    
         }
        public function addFriend($id)
        {
        	$Friendship = friendship::create([
            'requester' => $this->id, // who is logged in
            'user_requested' => $id,
           ]);
        
           if($Friendship)
           {
            
            return $Friendship;
           }
           return 'whoops,Something Went Wrong!!';
                
    }
      }
