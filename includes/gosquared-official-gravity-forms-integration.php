<?php

class GoSquaredGFIntegration {

  public function __construct() {
    add_action( 'gform_after_submission',  array($this, 'send'), 10, 2 );
  }

  public function send($entry, $form) {
    $standard_props = array(
        'Email' => 'email',
        'Name'=> 'name',
        'First Name' => 'first_name',
        'Last Name' => 'last_name',
        'Username' => 'username',
        'Description' => 'description',
        'Phone' => 'phone',
        'Company' => 'company_name',
        'Company Size' => 'company_size',
        'Company Industry' => 'company_industry',
        'Job Title' => 'company_position',
    );
    $fields = $form['fields'];
    ?>
    <script>
        var properties = {};
        properties.custom = {};
        <?php
        foreach($fields as $f){
          $object_key = $standard_props[$f['label']];
          $object_value = $entry[$f['id']];
            if(isset( $standard_props[$f['label']] )){
                if($object_value != ""){
                    ?>
                    properties['<?php echo $object_key ?>'] = '<?php echo $object_value ?>';
                    <?php
                }
            } else {
              if ($object_value != ""){
                  ?>
                  properties.custom['<?php echo $f['label'] ?>'] = '<?php echo $object_value ?>';
                  <?php
              }
            }
        }
        ?>
        if(!window._gs) {
        !function(g,s,q,r,d){r=g[r]=g[r]||function(){(r.q=r.q||[]).push(
         arguments)};d=s.createElement(q);q=s.getElementsByTagName(q)[0];
         d.src='//d1l6p2sc9645hc.cloudfront.net/tracker.js';q.parentNode.
         insertBefore(d,q)}(window,document,'script','_gs');

        _gs('GSN-628668-H');
        }
        _gs('identify', properties);
  </script>
<?php }

}
