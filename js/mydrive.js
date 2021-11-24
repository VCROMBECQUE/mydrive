document.addEventListener("load", getData(null));

var divstorage = document.getElementById("storage");

document.addEventListener(
  "contextmenu",
  (e) => {
    if (
      window.event.target.className.split(" ")[0] ==
        "userdrive_data_storage_container" ||
      window.event.target.parentNode.className.split(" ")[0] ==
        "userdrive_data_storage_container"
    ) {
      var x = e.pageX; 
      var y = e.pageY; 
      
      let link = "";
      window.event.target.tagName != "div" ? link = window.event.target.parentNode.id : link = window.event.target.id

      e.preventDefault();
      divstorage.innerHTML += `<div id="submenu" name="${link}" style="top:${y}px;left:${x}px">
                                  <button type="button" class="texting-1 p-1 m-1" type="button" onclick="renamedata()">Renommer</button>
                                  <button type="button" class="texting-1 p-1 m-1" type="button" onclick="removedata()">Supprimer</button>
                                  <button type="button" class="texting-1 p-1 m-1" type="button" onclick="closesubmenu()">Fermer</button>
                               </div>`;
    }
  },
  false
);

async function renamedata() {
  let dataren = window.event.target.parentNode.getAttribute('name').split("/");
  let datatoren = dataren[dataren.length - 1];


  let path = document.getElementById("ariane").lastChild.id;
  let newname = window.prompt('Entrer le nouveau nom : ');

  const data = {
    newname,
    datatoren,
    path,
  };
  console.log(data);

  const options = {
    method: "POST",
    body: JSON.stringify(data),
  };

  await fetch("../php/renamedata.php", options)
  .then(() => {
    getData(path);
  })
  .catch((error) => console.log("erreur fetch", error));
}

async function removedata() {
  let datadel = window.event.target.parentNode.getAttribute('name').split("/");
  let datatodel = datadel[datadel.length - 1];
  let path = document.getElementById("ariane").lastChild.id;

  const data = {
    datatodel,
    path,
  };

  const options = {
    method: "POST",
    body: JSON.stringify(data),
  };
  await fetch("../php/deletedata.php", options)
  .then(() => {
    getData(path);
  })
  .catch((error) => console.log("erreur fetch", error));
}

function closesubmenu() {
  window.event.target.parentNode.remove();
}

async function getData(folder) {
  const options = {
    method: "POST",
    body: JSON.stringify(folder),
  };

  await fetch("../php/getdata.php", options)
    .then((response) => {
      response.json().then((data) => {
        let storage = document.querySelector("#storage");
        let files = "";

        let ariane = document.querySelector("#ariane");

        let current = "";

        data.forEach((file) => {
          if (file.type != "current") {
            let action = "";
            let sourceimg = `src="../images/icon/${file.type}.png"`;

            if (file.type == "png" || file.type == "jpg") {
              sourceimg = `src=\"${file.url}\"`;
            }

            if (file.type == "folder") {
              action = 'ondblclick="changeDir()")';
            } else {
              action = `onclick=\"window.open('${file.url}', '_blank').focus()\"`;
            }

            files += `<div id="${current}${file.name}" class="userdrive_data_storage_container p-1" ${action}>
                          <img class="userdrive_data_storage_container_icon" ${sourceimg} alt="${file.type}">
                          <p class="userdrive_data_storage_container_name texting-2">${file.name}</p>
                      </div>`;
          } else {
            current = file.name;
          }
        });
        storage.innerHTML = files;
        ariane.innerHTML = getAriane(current);
      });
    })
    .catch((error) => console.log("erreur fetch", error));
}

function changeDir() {
  let elem = window.event.target;

  elem.tagName != "DIV" ? (elem = elem.parentNode.id) : (elem = elem.id);

  getData(elem);
}

function getAriane(path) {
  path = `MyDrive/${path}`;
  let splitpath = path.split("/");

  let ariane = "";
  let id = "";
  splitpath.forEach((element) => {
    if (element != "") {
      if (element != "MyDrive") {
        id += `/${element}`;
      }
      ariane += `<p id="${id}" class="ml-1"><i class="fas fa-chevron-right"></i> <span onclick="changeDir()">${element}</span> </p>`;
    }
  });

  return ariane;
}

function showNewFolder() {
  let newfolder = document.getElementById("addnewfolder");
  newfolder.className == "d-none"
    ? newfolder.classList.remove("d-none")
    : newfolder.classList.add("d-none");
}

async function addNewFolder() {
  let foldername = document.getElementById("newfoldername").value;
  let path = document.getElementById("ariane").lastChild.id;

  const data = {
    foldername,
    path,
  };

  const options = {
    method: "POST",
    body: JSON.stringify(data),
  };

  await fetch("../php/newfolder.php", options)
    .then(() => {
      getData(path);
      showNewFolder();
    })
    .catch((error) => console.log("erreur fetch", error));
}

async function addFile() {
  let newfile = document.querySelector("#file").files[0];
  let path = document.getElementById("ariane").lastChild.id;

  const form_data = new FormData();
  form_data.append("file", newfile);
  form_data.append("path", path);

  const options = {
    method: "POST",
    body: form_data,
  };

  await fetch("../php/addfile.php", options)
    .then((response) => {
      response.json().then((data) => {
        getData(path);
        alert(data);
        });
      })
    .catch((error) => console.log("erreur fetch", error));
}
