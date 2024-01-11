const renderCompanies = async function (companies) {
    try {
        const tableBody = document.getElementById("companyData");
        if (tableBody) {
            tableBody.innerHTML = "";

            const dynamicHtml = companies
                .map((company) => {
                    return `  <tr>
        <td>${company["id"]}</td>
        <td><img src="${company["logo"]}" /></td>
        <td>${company["name"]}</td>
        <td>${company["email"]}</td>
        <td><a href="${company["weburl"]}" target="_blank">Website</a></td>
        <td class="d-flex gap-2">
        <a href="/employee/${company["id"]}" class="button btn-warning">Employee</a>
            <a href="/company/edit/${company["id"]}" class="button btn-warning">Edit</a>
            <button type="button" data-id="${company["id"]}" class="btn-danger del">Delete</button></td>
    </tr>`;
                })
                .join("");

            tableBody.insertAdjacentHTML("afterbegin", dynamicHtml);
        }
    } catch (error) {
        console.log(error);
    }
};

const fetchCompany = async () => {
    const response = await fetch("http://127.0.0.1:8000/api/company");
    const data = await response.json();
    renderCompanies(data);
};

const deleteCompany = async () => {
    const deleteBtn = document.querySelectorAll(".del");

    if (deleteBtn) {
        deleteBtn.forEach((del) => {
            del.addEventListener("click", async (e) => {
                const id = e.target.dataset.id;

                await fetch("http://127.0.0.1:8000/api/company/" + id);
                fetchCompany();
            });
        });
    }
};

async function init() {
    await fetchCompany();
    await deleteCompany();
}

init();
