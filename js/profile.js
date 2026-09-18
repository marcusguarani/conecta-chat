const profileSection = document.getElementById("profileSection"),
editToggleBtn = document.getElementById("editToggleBtn"),
cancelEditBtn = document.getElementById("cancelEditBtn"),
saveEditBtn = document.getElementById("saveEditBtn"),
imageInput = document.getElementById("profileImageInput"),
picPreview = document.getElementById("profilePicPreview"),
fnameInput = document.getElementById("editFname"),
lnameInput = document.getElementById("editLname"),
bioInput = document.getElementById("editBio"),
errorBox = document.getElementById("profileError");

editToggleBtn.onclick = () => {
  errorBox.style.display = "none";
  profileSection.classList.add("is-editing");
};

cancelEditBtn.onclick = () => {
  location.reload();
};

imageInput.onchange = () => {
  const file = imageInput.files[0];
  if(file){
    picPreview.src = URL.createObjectURL(file);
  }
};

saveEditBtn.onclick = () => {
  const fname = fnameInput.value.trim();
  const lname = lnameInput.value.trim();

  if(fname === "" || lname === ""){
    errorBox.textContent = "Nome e sobrenome são obrigatórios!";
    errorBox.style.display = "block";
    return;
  }

  saveEditBtn.disabled = true;
  saveEditBtn.textContent = "Salvando...";

  const formData = new FormData();
  formData.append("fname", fname);
  formData.append("lname", lname);
  formData.append("bio", bioInput.value.trim());
  if(imageInput.files[0]){
    formData.append("image", imageInput.files[0]);
  }

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "profile-update.php", true);
  xhr.onload = () => {
    if(xhr.readyState === XMLHttpRequest.DONE){
      if(xhr.status === 200){
        const data = xhr.response;
        if(data === "success"){
          location.reload();
        }else{
          errorBox.textContent = data;
          errorBox.style.display = "block";
          saveEditBtn.disabled = false;
          saveEditBtn.textContent = "Salvar alterações";
        }
      }
    }
  };
  xhr.send(formData);
};
