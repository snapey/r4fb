module.exports = {
  purge: [
    './resources/views/**/*.blade.php',
    './resources/css/**/*.css',
  ],
  theme: {
    fontFamily: {
      'sans' : ['Roboto','sans-serif'],
      'mono' : ['monospace']
    },
    opacity: {
      '0': '0',
      '10': '.1',
      '20': '.2',
      '30': '.3',
      '40': '.4',
      '50': '.5',
      '60': '.6',
      '70': '.7',
      '80': '.8',
      '90': '.9',
      '100': '1',
    },
    extend: {
      keyframes: {
        'swing': {
          '0%,100%' : { transform: 'rotate(0deg)' },
          '25%' : { transform: 'rotate(-15deg)' },
          '75%' : { transform: 'rotate(15deg)' },
        }
      },
      animation: {
        'swing': 'swing 1s infinite linear'
      }
    }
  },
  variants: {},
  plugins: [
    require('@tailwindcss/custom-forms')
  ]
}
