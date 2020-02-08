<?php


namespace App\Lib;


class Uploader
{

    public  static $FILE;
    public  static $TMP;
    private static $Extension;
    private static $NewName;
    public  static $Destination='images/default_user.png';

    public  static  function CheckUserUploaded(){
            if (!empty(self::$FILE['name'])){
                return true;
            }else{
                return false;
            }
    }
    public static  function CheckSize(){
            if (file_exists(self::$FILE['tmp_name'])===false){
                //size bad
                 return false;
            }else{
//                $MAX_UPLOADED_SIZE=ini_get("max_file_uploads");
//                $MAX_UPLOADED_SIZE=settype($MAX_UPLOADED_SIZE,'integer');
//                $MAX_UPLOADED_SIZE=$MAX_UPLOADED_SIZE*1024*1024;
//                // make my own file size but should be less than or equal the server limit
//                echo 'in uploader size is'.$MAX_UPLOADED_SIZE;
//                if (self::$FILE['size']<=$MAX_UPLOADED_SIZE){
//                    //size good
//                    return true;
//                }else{
//                    return false;
//                }
                return true;
            }

    }
    private static  function ExtractExtension(){
        $FILE_PARTS=self::$FILE['name'];
        $FILE_PARTS=explode('.',$FILE_PARTS);
        $EXTENSION=end($FILE_PARTS);
        self::$Extension=$EXTENSION;
    }
    private static  function CheckExtension(){
        $EXTENSION=self::$Extension;
        $ALLOWED=array('png','jpg','jpeg','gif');
        if (in_array($EXTENSION,$ALLOWED)){
            return true;
        }else{
            return false;
        }
    }
    private static  function GenerateName(){
        $NAME=uniqid('mufix_instructor__').time().random_int(0,100);
        $NAME.='.'.self::$Extension;
        self::$NewName=$NAME;
        self::$Destination='UPLOADED/Instructors/'.self::$NewName;
}
    public  static  function RemoveOld($path){
        return (unlink($path))?true:false;
    }
    public  static  function Upload(){
            self::ExtractExtension();
            if (self::CheckExtension()){
                self::GenerateName();
                self::$TMP=self::$FILE['tmp_name'];
                $uploaded=move_uploaded_file(self::$TMP,self::$Destination);
                if ($uploaded===true){
                    return array(
                        'Msg'        =>'Image Uploaded Successfully',
                        'Type'       =>'success',
                        'Status'     =>true
                    );
                }else{
                    return array(
                        'Msg'        =>'Failed To Upload Image Invalid Image',
                        'Type'       =>'danger',
                        'Status'     =>false
                    );
                }
            }else{
                    return array(
                    'Msg'        =>'Failed To Upload Image Invalid Image Extension',
                    'Type'       =>'danger',
                    'Status'     =>false
                );
            }
    }


}