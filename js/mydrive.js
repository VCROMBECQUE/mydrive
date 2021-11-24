document.addEventListener("load", getData(null));

// document.addEventListener("change", getFiles())


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
            files += `<div id="${current}${file.name}" class="userdrive_data_storage_container p-1" ondblclick="changeDir()">
                          <img class="userdrive_data_storage_container_icon" src="../images/icon/${file.type}.png" alt="${file.type}">
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
    if(element != "")
    {
      if(element != "MyDrive") {
        id += `/${element}`;
      }
      ariane += `<p id="${id}" class="ml-1"><i class="fas fa-chevron-right"></i> <span onclick="changeDir()">${element}</span> </p>`;
    }
  });

  return ariane;
}

function showNewFolder() {
  let newfolder = document.getElementById("addnewfolder");
  newfolder.className=="d-none" ? newfolder.classList.remove("d-none") : newfolder.classList.add("d-none");
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
