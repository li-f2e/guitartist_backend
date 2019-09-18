let toggleBtn = document.querySelector('.left-menu-toggle-btn');
        // let upLine = document.querySelector('.up-line');
        // let lowerLine = document.querySelector('.lower-line');
        let leftMenu = document.querySelector('.left-menu');
        let cardHeaders = document.querySelectorAll('.my-card-header');
        let eachCardCollapse = document.querySelectorAll('.collapse');


        // 左側導覽列
        toggleBtn.onclick = function () {
            // upLine.classList.toggle('active');
            // lowerLine.classList.toggle('active');
            this.classList.toggle('active');
            leftMenu.classList.toggle('active');
            eachCardCollapse.forEach(function (CardCollapse) {
                CardCollapse.classList.remove('show');
            });

            cardHeaders.forEach(function (cardHeader) {
                if (cardHeader.className == "card-header my-card-header p-0 active" && leftMenu.className == 'left-menu active') {
                    cardHeader.classList.add('ball');
                }
                else {
                    cardHeader.classList.remove('ball');
                }

            });

        };



        
        // 用add className寫
        cardHeaders.forEach(function (cardHeader) {

            cardHeader.onclick = function (e) {

                cardHeaders.forEach(function (cardHeader) {
                    cardHeader.classList.remove('active');
                    cardHeader.firstElementChild.firstElementChild.classList.remove('active');
                });

                this.classList.add('active');
                this.firstElementChild.firstElementChild.classList.add('active');

                leftMenu.classList.remove('active');

                if (cardHeader.className == "card-header my-card-header p-0 ball active") {
                    cardHeader.classList.remove('ball');
                }
            }

        })