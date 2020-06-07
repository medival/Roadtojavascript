const button = document.getElementById("buttonAdd");
button.addEventListener("click", function () {
    // console.log(title);
    const title = document.getElementById('inputTitle').value;
    const author = document.getElementById('inputAuthor').value;
    const isbn = document.getElementById('inputISBN').value;
    const bookList = document.getElementById("bookList");
    const html = `<tr>
                    <td> ${title}</td>
                    <td> ${author} </td>
                    <td> ${isbn} </td>
                </tr>`;
    bookList.innerHTML = html;
})