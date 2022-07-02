<script>

function notification(type, name){
if(type == 'success'){
return toastr[type](${name} added successfully.)
}
else if(type == 'info'){
return toastr[type](${name} updated sucessfully.)
}
else if(type == 'error'){
return toastr[type](${name} removed.)
}
else if(type == 'custom'){
return toastrtype
}
}

</script>