document.addEventListener('alpine:init', () => {
  Alpine.data('searchForm', () => ({
    certificateNumber: '', // Изменили vin на certificateNumber
    result: null,
    settings: apiSettings,
    show_results: false,
    loading: false,
    status: '',
    letter: '',
    type_org: '',
    consult_direction: '',
    course_name: '',
    last_name: '',
    next_date: '',
    status_info: '',
    status_help: '',
    error: false,
    init: function () {
      this.$watch('result', () => {
        // обновление переменных, если сертификат не найден
        if (typeof this.result.crt_info == 'undefined') this.status_info = this.result.status_info;
        if (typeof this.result.crt_info == 'undefined') this.status_help = this.result.status_help;

        // обновление переменных, если сертификат найден
        if (typeof this.result.crt_info !== 'undefined') this.type_org = this.result.crt_info.type_org;
        if (typeof this.result.crt_info !== 'undefined') this.consult_direction = this.result.crt_info.consult_direction;
        if (typeof this.result.crt_info !== 'undefined') this.course_name = this.result.crt_info.course_name;
        if (typeof this.result.crt_info !== 'undefined') this.last_name = this.result.crt_info.last_name;
        if (typeof this.result.crt_info !== 'undefined') this.next_date = this.result.crt_info.next_date.replaceAll('-','.');

        // обновление переменной, если возникла ошибка
        if (typeof this.result.error !== 'undefined') this.error = this.result.error;
      });

      this.$watch('certificateNumber', () => {
        if (this.certificateNumber === '') {
          this.reset();
          this.show_results = false;
        }
      });

      // Извлекает параметр запроса и выполнить поиск:
      const urlParams = new URLSearchParams(window.location.search);
      const certificateNumberParam = urlParams.get('certificateNumber');
      if (certificateNumberParam) {
        this.certificateNumber = certificateNumberParam;
        this.searchDatabase();
      }
    },


    reset: function () {
      this.status = '';
      this.letter = '';
      this.type_org = '';
      this.consult_direction = '';
      this.course_name = '';
      this.last_name = '';
      this.next_date = '';
      this.status_info = '';
      this.status_help = '';
      this.error = false;
    },

    searchDatabase: async function () {
      this.show_results = true;
      this.reset();

      if (this.certificateNumber === '') {
        this.status = '‼ Номер сертификата не указан';
        this.error = true;
        return;
      }

      this.loading = true;

      let response = await fetch(
        this.settings.root + this.settings.namespace + '/certificate', // Изменили vin на certificateNumber
        {
          method: 'POST',
          credentials: 'same-origin',
          headers: new Headers({
            'Content-Type': 'application/json;charset=UTF-8',
            'X-WP-Nonce': this.settings.nonce,
          }),
          body: JSON.stringify({ certificateNumber: this.certificateNumber }), // Изменили vin на certificateNumber
        }
      )
        .then((response) => response.json())
        .then((data) => {
          this.result = data;
          this.result.crt_info = JSON.parse(data.crt_info)
          this.loading = false;
        })
        .catch((error) => {
          console.error('Error:', error);
          this.loading = false;
        });
    },

    mainClass: function () {
      return {
        'show-results': this.show_results,
      };
    },

    btnClass: function () {
      return {
        'disabled': this.loading,
      };
    },

    resultClass: function () {
      return {
        'loading': this.loading,
        'failure': this.error && this.status !== '',
        'success': !this.error && this.status !== '',
      };
    },
    isResultAvailable: function () {
      return (
        this.type_org ||
        this.consult_direction ||
        this.course_name ||
        this.last_name ||
        this.next_date ||
        this.status_info ||
        this.status_help
      );
    },
  }));
});
