import toggleController from '../plugins/toggleController';
import contextBarController from '../plugins/contextBarController';
import scrollTo from '../plugins/scrollTo';

export default {
  init() {
    // JavaScript to be fired on all pages
    const videoElements = 'iframe[src*="youtube"], iframe[src*="vimeo"], iframe[src*="youtu.be"]';
    $(videoElements).parent().fitVids();
    toggleController();
    contextBarController();
    scrollTo();
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
