var firebaseConfig = {
  apiKey: "AIzaSyDQM4h9TpNJbksoTLdzn3Vlk_lS_gZ_6S4",
  authDomain: "tpsit-15d0b.firebaseapp.com",
  databaseURL: "https://tpsit-15d0b.firebaseio.com",
  projectId: "tpsit-15d0b",
  storageBucket: "tpsit-15d0b.appspot.com",
  messagingSenderId: "1019912647899",
  appId: "1:1019912647899:web:80027055b67346a5e908fe",
  measurementId: "G-2Z8QHYM5JY"
};
 
// Initialize Firebase
firebase.initializeApp(firebaseConfig);

const dbRef = firebase.database().ref();
const usersRef = dbRef.child('libri');
const userListUI = document.getElementById("userList");

// visualizza la lista 
usersRef.on("child_added", snap => {
  let user = snap.val();
  let $li = document.createElement("li");
  $li.innerHTML = user.titolo;
  $li.setAttribute("child-key", snap.key);
  $li.addEventListener("click", userClicked)
  userListUI.append($li);
});

function userClicked(e) {
	var userID = e.target.getAttribute("child-key");
	const userRef = dbRef.child('libri/' + userID);
	const userDetailUI = document.getElementById("userDetail");

	userDetailUI.innerHTML = ""
	userRef.on("child_added", snap => {
		var $p = document.createElement("p");
		$p.innerHTML = snap.key  + " - " +  snap.val()
		userDetailUI.append($p);
	});
}