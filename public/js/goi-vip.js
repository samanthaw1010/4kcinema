let monthBtns = document.querySelectorAll("input[name='month']");

let resultMonth = document.getElementById('result-month');
let resultPrice = document.getElementById('result-price');

let startDate = document.querySelector('.effective-date');
let endDate = document.querySelector('.date-use');

let nextPayment = document.querySelector('.next-payment');
let nextPaymentDate = document.querySelector('.next-payment .next-payment-date');

let totalPrice = document.querySelector('.total-price');

let findSelected = () => {
    let selectedMonth = document.querySelector("input[name='month']:checked").dataset.month;
    let selectedPrice = document.querySelector("input[name='month']:checked").dataset.price;
    let currentDate = new Date();
    let nextMonthDate = new Date(currentDate);

    resultMonth.textContent = selectedMonth;
    resultPrice.textContent = selectedPrice + ' đồng';
    totalPrice.textContent = selectedPrice + ' đồng';

    if (document.querySelector("input[name='month']:checked").id === 'one') {
        nextMonthDate.setDate(currentDate.getDate() + 30);
        startDate.textContent = `${currentDate.getDate()}/${currentDate.getMonth() + 1}/${currentDate.getFullYear()}`;
        endDate.textContent = 'Khi bạn hủy';

        nextPayment.style.display = 'flex';
        nextPaymentDate.textContent = `${nextMonthDate.getDate()}/${
            nextMonthDate.getMonth() + 1
        }/${nextMonthDate.getFullYear()}`;
    } else {
        nextMonthDate.setDate(currentDate.getDate() + 30);

        startDate.textContent = `${currentDate.getDate()}/${currentDate.getMonth() + 1}/${currentDate.getFullYear()}`;
        endDate.textContent = `${nextMonthDate.getDate()}/${
            nextMonthDate.getMonth() + 1
        }/${nextMonthDate.getFullYear()}`;

        nextPayment.style.display = 'none';
        nextPaymentDate.textContent = ''; // Xóa ngày thanh toán tiếp theo
    }
};

document.querySelector('#one').checked = true;
document.querySelector('#vnpay').checked = true;
findSelected();

monthBtns.forEach((monthBtn) => {
    monthBtn.addEventListener('change', findSelected);
});
