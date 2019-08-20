@extends('layouts.master')

@section('title')
Create Record
@endsection
        
@section('content')
<div>
    <form method="POST" action="/records/create" class="firs-form">
        @csrf

        <div class="form-group">
            <label for="type">Record Type</label>
            <select name="type" id="type" class="form-control" id="type">
                <option value="-">Select Record Type</option>
                <option value="mail">Documents</option>
                <option value="document">File</option>
            </select>
        </div>

        <div class="form-group">
            <label for="in_date">Incoming Date</label>
            <input type="date" value="{{ $today }}" class="form-control" name="in_date" id="in_date" required>
        </div>

        <div class="form-group">
            <label for="reference_no">Reference Number</label>
            <input type="text" class="form-control" name="ref_no" id="ref_no">
        </div>

        <div class="form-group">
            <label for="name">Name/Particulars</label>
            <input type="text" class="form-control" name="name" id="name" required>
        </div>

        <div class="form-group" id="subject_div">
            <label for="subject">Subject</label>
            <input type="text" class="form-control" name="subject" id="subject">
        </div>

        <div class="form-group">
            <input type="checkbox" id="outgoing_check" name="outgoing_check" checked>
            <label for="outgoing_check">Incoming mail</label>
        </div>

        <div class="form-group">
            <label for="out_date">Outgoing Date</label>
            <input type="date" class="form-control" name="out_date" id="out_date" disabled>
        </div>
        <div class="form-row">

            <div class="field_wrapper">
                
                <div class="form-group col-md-10">
                    <label for="destination">Destination</label>

                    <input type="text" class="form-control input-lg" name="destination" id="destination" list="listid">
                    {{-- <select name="destination" id="destination" class="form-control">
                        <option value="-">Select Destination</option>
                        @foreach ($departments as $department)
                            <option value="{{$department->id}}">
                                {{$department->name}}
                            </option>
                        @endforeach
                    </select> --}}
                </div>
            </div>

            <div class="form-group col-md-2">
                <label for="">&nbsp; </label>
                <input type="button" value="Add Destination" class="form-control" name="add_destination" id="add_destination">
            </div>

        </div>

        
        {{-- <datalist id='listid'>
            @foreach ($departments as $department)
            <option value='{{$department->name}}'>
            @endforeach
        </datalist> --}}
    

        {{-- <div class="form-group">
            <label for="department">Department</label>
            <select name="showDepartment" id="showDepartment" class="form-control" disabled>
                
                    <option value="{{$current_dept->id}}">
                        {{$current_dept->name}}
                    </option>
                

            </select>
        </div> --}}

        {{-- <input type="hidden" name="department" value="{{$current_dept->id}}" /> --}}
        {{-- <input type="hidden" name="department_name" value="{{$current_dept->name}}"> --}}

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>
@endsection
<script src="/js/jquery-3.2.1.min.js"></script>

<script>
$(document).ready(function() {
    console.log("Ready!!");

    $(function() {
        show_outgoing();
        $("#outgoing_check").click(show_outgoing);
    });

    function show_outgoing() {
        $("#out_date").prop("disabled", this.checked);
    }

    // $('#destination').select2({
    //         // closeOnSelect: true,
    //         placeholder: "Start typing to search",
    //         maximumSelectionLength: 2,
            
    //     });

    // $("#type").on("change", function(){
    //     if($("#type").val() == 'document'){
    //         $("#ref_no").val("");
    //     }
    //     if($("#type").val() == 'mail'){
    //         $("#ref_no").val("");
    //     }
    // });

    $.ajax({
        url: '{{ url('countfiles') }}',
        type: 'GET',
        dataType: 'html',

        success: function(data){
            console.log('ajax call successfull');
            console.log(data);

            //get the date value for a default reference no
            var raw_init_date = $("#in_date").val();

            //remove slashes from init date
            var init_date = raw_init_date.replace(/-/g, "");

            //combine date with ID
            var reference = "" + init_date + data;


            $("#type").on("change", function(){
                if($("#type").val() == 'document'){
                    $("#ref_no").val("");
                    // $("#subject_div").hide();
                }
                if($("#type").val() == 'mail'){
                    $("#ref_no").val(reference);
                    // $("#subject_div").show();
                }
            });

            //Populate ref_no field
            $("#ref_no").val(reference);

            $("#in_date").on("change", function(){
                console.log('Datepicker changed');
                var rawDate = $("#in_date").val();
                var date = rawDate.replace(/-/g, "");

                //combine date with ID
                var newreference = "" + date + data;
                console.log(newreference);

                $("#ref_no").val(newreference);

                
            });
        }

                    
    })

    //Add Destination Button Code Starts


    $(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('#add_destination'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><input type="text"  list="listid" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button"><img src="/img/delete.png"/></a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});


    // Add Destination Button Code Ends 
    
});
</script>