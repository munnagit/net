<select id="oap">
  <option value="No">No</option>
  <option value="Yes">Yes</option>
</select>

<select id="opn">
  <option value="blank">&nbsp;</option>
</select>


<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script>
var lookup = {
   'No': ['Deposit','Withdrawal'],
   'Yes': ['Withdrawal']
   };

$('#oap').on('change', function() {
   // Set selected value as variable
   var selectValue = $(this).val();
   // Empty the schools select field
   $('#opn').empty();
   // For each school in the selected country
   for (i = 0; i < lookup[selectValue].length; i++) {
      // Output school
      $('#opn').append("<option value='" + lookup[selectValue][i] + "'>" + lookup[selectValue][i] + "</option>");
   }
});
</script>
