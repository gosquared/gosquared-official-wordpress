<?php

class GoSquaredGFIntegration {

  private $project_token;

  private $standard_props;

  private $valid_types;

  private $properties = array();

  public function __construct($project_token) {
    $this->project_token = $project_token;
    $this->properties['custom']=array();

    add_action( 'gform_after_submission',  array($this, 'send'), 10, 2 );
    $this->standard_props = array(
        'Email' => 'email',
        'Name'=> 'name',
        'First Name' => 'first_name',
        'Last Name' => 'last_name',
        'Description' => 'description',
        'Phone' => 'phone',
        'Company' => 'company_name',
        'Company Size' => 'company_size',
        'Company Industry' => 'company_industry',
        'Job Title' => 'company_position',
    );
    $this->valid_types = array('text', 'website', 'phone', 'number', 'date', 'time', 'name', 'address', 'email', 'username');
  }

  public function map_properties($entry, $form_input) {
    if (isset($entry[$form_input['id']]) && $entry[$form_input['id']] != "") {
    if(isset( $this->standard_props[$form_input['label']] )) {
      $label = $this->standard_props[$form_input['label']];
            $this->properties[$label] = $entry[$form_input['id']];
    } else {
          $this->properties['custom'][$form_input['label']] = $entry[$form_input['id']];
      }
    }
  }

  public function send($entry, $form) {
    $fields = $form['fields'];
    ?>
    <script>
        <?php
        foreach($fields as $f) {
          if ($f['type']==='creditcard' || $f['type']==='password' ) {
            continue;
          }
           if (in_array($f['type'], $this->valid_types)) {
           if (is_array($f["inputs"])) {
            foreach($f["inputs"] as $input) {
              $this->map_properties($entry, $input);
            }
          }
          $this->map_properties($entry, $f);
          if ($f['type']==='email' && $entry[$f['id']] != ''){
              $this->properties['email'] = $entry[$f['id']];
          }
        }
      }
        ?>
        if(!window._gs) {
        !function(g,s,q,r,d){r=g[r]=g[r]||function(){(r.q=r.q||[]).push(
         arguments)};d=s.createElement(q);q=s.getElementsByTagName(q)[0];
         d.src='//d1l6p2sc9645hc.cloudfront.net/tracker.js';q.parentNode.
         insertBefore(d,q)}(window,document,'script','_gs');
        _gs('<?php echo $this->project_token; ?>');
        }
        _gs('identify', <?php echo json_encode($this->properties); ?>);
  </script>
<?php }

}
