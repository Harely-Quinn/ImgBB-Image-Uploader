const image = document.querySelector('input[name="img"]');
const upbtn = document.querySelector('input[name="upload"]');
const label = document.querySelector('label[for="input"]');

image.addEventListener('change', () => {
  const imageExt = image.value.split('.').pop();
  const allowedExt = ['jpg', 'jpeg', 'png', 'gif'];
  if(image.value == '') {
    label.innerHTML = '<i class="fas fa-upload"></i> Select Image';
  } else if(allowedExt.includes(imageExt) == false) {
    swal({
      type: 'error',
      title: 'Error!',
      text: 'Filetype not allowed!'
    });
    image.value = null;
    label.innerHTML = '<i class="fas fa-upload"></i> Select Image';
  } else {
    label.innerText = image.value;
  }
});

upbtn.addEventListener('click', (e) => {
  if(image.value == '') {
    swal({
      type: 'error',
      title: 'Error!',
      text: 'Image form can\'t be empty'
    });
    e.preventDefault();
  }
});

const copy = document.querySelector('#copy');
copy.addEventListener('click', () => {
  //alert('id');
  const link = document.querySelector('#link');
  input.focus();
  link.select();
  navigator.clipboard.writeText(link.value)
  .then(() => {
    copy.innerText = 'Copied!';
  });
});