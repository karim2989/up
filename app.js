const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");
const region = document.querySelector("#region");
const country = document.querySelector("#country");
const button = document.getElementById("boutton");
const button2 = document.getElementById("submit");
const email = document.querySelector("#email");
const password = document.querySelector("#pass");

// Events
sign_up_btn.addEventListener("click", () => {
  container.classList.add("sign-up-mode");
});

sign_in_btn.addEventListener("click", () => {
  container.classList.remove("sign-up-mode");
});
// Verification
function verify() {
  if(false && password.value.length<6){
    alert("Your password length must be superior of 6");
    return false;
}
}
