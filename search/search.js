function searchB(sql,afterSql,sqlC,file) {
    button =  document.getElementById("search")
    term = button.value
    console.log(sql)
    console.log(term)
    //button.style.backgroundColor= "#aaaaaa"
    $.ajax({
        url: 'search/search.php',
        type: 'POST',
        //data: 'username=' + username + '&email=' + email + '&password=' + password + '&js=' + 1 + "&name=" + name + "&surname=" + surname,
        data: {
            sql: sql,
            sTerm: term,
            afterSql: afterSql,
            sqlC: sqlC
        },
        success: function (response) {
            console.log(response)
            $.ajax({
                url: file,
                type: 'POST',
                //data: 'username=' + username + '&email=' + email + '&password=' + password + '&js=' + 1 + "&name=" + name + "&surname=" + surname,
                data: {
                    newSql: response
                },
                success: function (res) {
                    body = document.getElementsByTagName("body");
                    body[0].innerHTML = res;
                }

            })
        }

    })
    return false;
}
function dummy(){
    document.getElementById("search").style.backgroundColor= "#aaaaaa"
}