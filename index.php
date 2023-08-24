<!doctype html>
<html lang="en">
  <head>
    <title>Create new plugin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  </head>
  <body>

    <div class="container p-5 border border-2 mt-5 ">
      <h2>Generate New Plugin</h2>
      <form action="" method="POST" enctype="multipart/form-data">
        <form class="form-inline mt-3">
          <div class="form-group">
            <label for="plugin_name" >Plugin Name :</label>
            <input type="text" name="plugin_name" class="form-control"  placeholder="Enter Plugin Name">          
          </div>
          
          <div class="form-group mt-3">
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>          
          </div>          
        </form>
      </form>
    </div>
      <?php

        if(isset($_POST['submit']))
        {
          
          $plugin_name = $_POST['plugin_name'];  
          generate_new_plugin('w3speedster',$plugin_name);
          generate_new_plugin('w3speedster',$plugin_name);   

          $new_plugin_name = trim( $plugin_name);
          $lower_case_plugin_name = strtolower($new_plugin_name);
          $lower_case_with_dash_plugin_name = str_replace(' ','-',$lower_case_plugin_name);
          $target_dir = "new_plugin/".$lower_case_with_dash_plugin_name."/assets/images/";

          $target_file =  $target_dir . 'w3-logo.png';
          unlink($target_file);
          copy("uploads/w3-logo.png", $target_file); 


          
        }        

          function generate_new_plugin($source_plugin_dir,$new_plugin_name) 
          {     
            
            $new_plugin_name = trim( $new_plugin_name);
            $lower_case_plugin_name = strtolower($new_plugin_name);
            $lower_case_with_dash_plugin_name = str_replace(' ','-',$lower_case_plugin_name);
            $new_plugin_name =$lower_case_with_dash_plugin_name;
                
            $result = array();
            $temp_dir = 'new_plugin'.'/'.$source_plugin_dir;  
            $cdir = scandir($source_plugin_dir);
            foreach ($cdir as $key => $value)
            {
               if (!in_array($value,array(".","..")))
               {
                  if (is_dir($source_plugin_dir . DIRECTORY_SEPARATOR . $value))
                  {
                     $result[$value] = generate_new_plugin($source_plugin_dir . DIRECTORY_SEPARATOR . $value,$new_plugin_name);

                     if (!file_exists('new_plugin/'.$source_plugin_dir . '/'. $value))
                     {
                        $new_dir = str_replace('w3speedster',$new_plugin_name,$source_plugin_dir);
                        mkdir('new_plugin/'.$new_dir .'/' . $value, 0777, true);
                     }                     
                  }
                  else
                  {                    
                    $result[] = $value;    
                    $file = $temp_dir.'/'.$value;
                    $main_plugin_dir = $file;
                    $main_plugin_dir = str_replace('new_plugin/','',$main_plugin_dir);
                    $main_plugin_single_file_content = file_get_contents(__DIR__.'/'.$main_plugin_dir);
                    $main_plugin_single_file_content = conver_plugin_file($main_plugin_single_file_content,$new_plugin_name);
                    $destination_file_dir = str_replace('w3speedster',$new_plugin_name,$file);
                    
                    file_put_contents($destination_file_dir, $main_plugin_single_file_content); 
                  }
               }
            }           
            return $result;
          }

         
         
          function conver_plugin_file($file_url,$new_plugin_name)          
          {   
            $new_plugin_name = str_replace('-',' ',$new_plugin_name);       
            $new_plugin_name = ucwords($new_plugin_name);
            $plugin_name = trim( $new_plugin_name);
            $lower_case_plugin_name = strtolower($plugin_name);
            $lower_case_with_dash_plugin_name = str_replace(' ','-',$lower_case_plugin_name);
            $under_score_plugin_name = str_replace(' ','_',$lower_case_plugin_name);
            $lower_case_plugin_name = str_replace(' ','',$lower_case_plugin_name);
            $upper_case_plugin_name = strtoupper($plugin_name);
            $upper_case_plugin_name = str_replace(' ','_',$upper_case_plugin_name);
            $cammel_case_plugin_name = ucwords($plugin_name);
            $cammel_case_plugin_name = str_replace(' ','',$cammel_case_plugin_name);
            
            $cloud_url = 'https://cloud.w3speedster.com/optimize/';  
            $documentation_url = "https://w3speedster.com/w3speedster-documentation/";
            $contact_us_url = "https://w3speedster.com/contact-us/";

            $remote_url = 'https://w3speedster.com';
            $w3speedster_php = $file_url;
            $lower_case_temp_name = 'lower_case_temp_name';
            $upper_case_temp_name = 'upper_case_temp_name';
            $capitalize_case_temp_name = 'captilize_case_temp_name';
            $w3speedster_php = str_replace($contact_us_url,'contact_us_url',$w3speedster_php);
            $w3speedster_php = str_replace($documentation_url,'documentation_url',$w3speedster_php);
            $w3speedster_php = str_replace($cloud_url,'cloud_url',$w3speedster_php);
            $w3speedster_php = str_replace($remote_url,'my_remote_url',$w3speedster_php);
            

            $w3speedster_php = str_replace('speed',$lower_case_temp_name,$w3speedster_php);
            $w3speedster_php = str_replace('SPEED',$upper_case_temp_name,$w3speedster_php);
            $w3speedster_php = str_replace('Speed',$capitalize_case_temp_name,$w3speedster_php);

            
            $w3speedster_php = str_replace("'settings.php','W3".$lower_case_temp_name."ster', 'W3".$lower_case_temp_name."ster',","'settings.php','".$new_plugin_name."', '".$new_plugin_name."',",$w3speedster_php);
            $w3speedster_php = str_replace("'W3".$lower_case_temp_name."ster', 'W3".$lower_case_temp_name."ster',","'".$new_plugin_name."', '".$new_plugin_name."',",$w3speedster_php); 
            $w3speedster_php = str_replace('W3'.$capitalize_case_temp_name.'ster Pro',$new_plugin_name,$w3speedster_php);
            
            $w3speedster_php = str_replace('W3'.$upper_case_temp_name.'STER',$upper_case_plugin_name,$w3speedster_php);
            $w3speedster_php = str_replace('W3'.$capitalize_case_temp_name.'ster',$cammel_case_plugin_name,$w3speedster_php);
            $w3speedster_php = str_replace('wp-'.$lower_case_temp_name.'ster','wp-'.$lower_case_with_dash_plugin_name,$w3speedster_php);  
            $w3speedster_php = str_replace('wp-'.$lower_case_temp_name.'ster',$lower_case_with_dash_plugin_name,$w3speedster_php);
            $w3speedster_php = str_replace('w3'.$lower_case_temp_name.'ster',$under_score_plugin_name,$w3speedster_php);
            $w3speedster_php = str_replace('W3'.$lower_case_temp_name.'ster',$cammel_case_plugin_name,$w3speedster_php);
            $w3speedster_php = str_replace('w3'.$lower_case_temp_name.'up',$under_score_plugin_name,$w3speedster_php);
            $w3speedster_php = str_replace('w3_'.$lower_case_temp_name.'ster',$under_score_plugin_name,$w3speedster_php);
            $w3speedster_php = str_replace('w3_'.$lower_case_temp_name.'up',$under_score_plugin_name,$w3speedster_php);
            $w3speedster_php = str_replace('w3-'.$lower_case_temp_name.'ster',$lower_case_with_dash_plugin_name,$w3speedster_php);
            $w3speedster_php = str_replace('w3'.$lower_case_temp_name.'ster',$under_score_plugin_name,$w3speedster_php);
            $w3speedster_php = str_replace('w3'.$lower_case_temp_name.'up',$under_score_plugin_name,$w3speedster_php);
            $w3speedster_php = str_replace('w3'.$lower_case_temp_name,$under_score_plugin_name,$w3speedster_php);
            $w3speedster_php = str_replace($lower_case_temp_name,$under_score_plugin_name,$w3speedster_php); 

            $w3speedster_php = str_replace($lower_case_temp_name,'speed',$w3speedster_php);
            $w3speedster_php = str_replace($upper_case_temp_name,'SPEED',$w3speedster_php);
            $w3speedster_php = str_replace($capitalize_case_temp_name,'Speed',$w3speedster_php);

            $w3speedster_php = str_replace('my_remote_url',$remote_url,$w3speedster_php);
            $w3speedster_php = str_replace('cloud_url',$cloud_url,$w3speedster_php);
            $w3speedster_php = str_replace('documentation_url','https://riised.dk/riised-performance-dokumentation/',$w3speedster_php);
            $w3speedster_php = str_replace('contact_us_url','https://riised.dk/kontakt/',$w3speedster_php);

            return $w3speedster_php;
            
          }
  
    ?>

  </body>
</html>