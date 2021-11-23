
prefix = ""

axios.post("http://localhost/list.php", {
    prefix: "storage/" + prefix
})

let data = [
    {
        name: "secret",
        type: "folder",
        url: "http://localhost/storage/secret",
        size: 1200,
    },
    {
        name: "chaton",
        type: "jpg",
        url: "http://localhost/storage/chaton.jpg",
        size: 1200
    },
    {
        name: "chiot",
        type: "png",
        url: "http://localhost/storage/chiot.png",
        size: 2650
    }
]

let mydrive = document.querySelector("#mydrive")

data.map(f => {
    mydrive.innerHTML
})