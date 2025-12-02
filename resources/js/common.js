// 備考欄の改行をする自作関数
const nl2br = (str) => {
    if (!str) return ""; // nullやundefinedでも対応

    let res = str.replace(/\r\n/g, "<br>");
    res = res.replace(/(\n|\r)/g, "<br>");

    return res;
}

// その日の年日を取得する自作関数
const getToday = () => {
    const today = new Date();
    const yyyy = today.getFullYear();
    const mm = ("0" + (today.getMonth()+1)).slice(-2); // 0~11月の取得なので、+1をして1~12月に変換　先頭に"0"をプラスしているので、01~012月になるので、slice(-2)で後ろ2桁の数字だけを取得する
    const dd = ("0" + (today.getDate())).slice(-2);
    return yyyy + '-' + mm + '-' + dd;
}

export { nl2br, getToday }
