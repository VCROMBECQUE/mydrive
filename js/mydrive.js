document.addEventListener("load", getData(null));

async function getData(folder) {
  let newfolder = { path: folder };

  const options = {
    method: "POST",
    body: JSON.stringify(newfolder),
  };

  console.log(JSON.stringify(newfolder));

  await fetch("../php/getdata.php", options)
    .then((response) => {
      response.json().then((data) => {
        let storage = document.querySelector("#storage");
        let files = "";
        data.forEach((file) => {
          files += `<div id="${file.name}" class="userdrive_data_storage_container p-1" onclick="changeDir()">
                        <img class="userdrive_data_storage_container_icon" src="../images/icon/${file.type}.png" alt="${file.type}">
                        <p class="userdrive_data_storage_container_name texting-2">${file.name}</p>
                    </div>`;
        });
        // console.log(files);
        storage.innerHTML = files;
      });
    })
    .catch((error) => console.log("erreur fetch", error));
}

function changeDir() {
  let elem = window.event.target;

  elem.tagName != "DIV" ? (elem = elem.parentNode.id) : (elem = elem.id);
  
//   console.log("elem : " + elem);
  getData(elem);
}

/* <div class="userdrive_data_storage_container p-1">
<img class="userdrive_data_storage_container_icon" src="../images/icon/folder.png" alt="folder">
<p class="userdrive_data_storage_container_name texting-2">secret</p>
</div> */

// prefix = ""

// axios.post("http://localhost/list.php", {
//     prefix: "storage/" + prefix
// })

// let data = [
//     {
//         name: "secret",
//         type: "folder",
//         url: "http://localhost/storage/secret",
//         size: 1200,
//     },
//     {
//         name: "chaton",
//         type: "jpg",
//         url: "http://localhost/storage/chaton.jpg",
//         size: 1200
//     },
//     {
//         name: "chiot",
//         type: "png",
//         url: "http://localhost/storage/chiot.png",
//         size: 2650
//     }
// ]

// let mydrive = document.querySelector("#mydrive")

// data.map(f => {
//     mydrive.innerHTML
// })
