
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{ asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js')}}"></script>
<!-- icheck -->
<script src="{{ asset('plugins/iCheck/icheck.min.js')}}"></script>
<!-- date-range-picker -->
<script src="{{ asset('bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- bootstrap datepicker -->
<script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- bootstrap time picker -->
<script src="{{ asset('plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>

<script type="text/javascript" src="{{ asset('bower_components/jQuery-TagsInput/src/jquery.tagsinput.js')}}"></script>


<script>
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })
</script>


<script>
  $(function () {
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>

<script type="text/javascript">

  function onAddTag(tag) {
    alert("Added a tag: " + tag);
  }
  function onRemoveTag(tag) {
    alert("Removed a tag: " + tag);
  }

  function onChangeTag(input,tag) {
    alert("Changed a tag: " + tag);
  }

  $(function() {

    $('#tags_1').tagsInput({width:'auto'});
    $('#tags_2').tagsInput({
      width: 'auto',
      onChange: function(elem, elem_tags)
      {
        var languages = ['php','ruby','javascript'];
        $('.tag', elem_tags).each(function()
        {
          if($(this).text().search(new RegExp('\\b(' + languages.join('|') + ')\\b')) >= 0)
            $(this).css('background-color', 'yellow');
        });
      }
    });
    $('#tags_3').tagsInput({
      width: 'auto',
      //autocomplete_url:'test/fake_plaintext_endpoint.html' //jquery.autocomplete (not jquery ui)
      autocomplete_url:'test/fake_json_endpoint.html' // jquery ui autocomplete requires a json endpoint
    });


// Uncomment this line to see the callback functions in action
//			$('input.tags').tagsInput({onAddTag:onAddTag,onRemoveTag:onRemoveTag,onChange: onChangeTag});

// Uncomment this line to see an input with no interface for adding new tags.
//			$('input.tags').tagsInput({interactive:false});
  });

</script>



<script>
  $(function () {
    $('.reservation').daterangepicker()
  })
</script>
