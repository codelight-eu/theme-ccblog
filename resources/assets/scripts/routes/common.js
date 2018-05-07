import toggleController from '../plugins/toggleController';
export default {
  init() {
    // JavaScript to be fired on all pages
    var videoElements = 'iframe[src*="youtube"], iframe[src*="vimeo"], iframe[src*="youtu.be"]';
    $(videoElements).parent().fitVids();
    toggleController();
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
