import 'jquery.scrollto';

const scrollTo = () => {

  const Settings = {
    offset: -60,
  };

  const Attributes = {
    SPEED: 'data-scrollTo-speed',
    URL: 'href',
  };

  const $element = {
    CLICKABLE: $(`[${Attributes.SPEED}]`),
  };

  function init() {
    $element.CLICKABLE.on('click', function(event){
      event.preventDefault();
      const urlSplitter = $element.CLICKABLE.attr(Attributes.URL).split('#');
      const target = urlSplitter[1];
      $.scrollTo($(`#${target}`), $element.CLICKABLE.attr(Attributes.SPEED), Settings);
    });
  }

  init();
};

export default scrollTo();