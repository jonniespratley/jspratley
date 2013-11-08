'use strict'

describe 'Service: Jsspeech', () ->

  # load the service's module
  beforeEach module 'JspratleyApp'

  # instantiate service
  Jsspeech = {}
  beforeEach inject (_Jsspeech_) ->
    Jsspeech = _Jsspeech_

  it 'should do something', () ->
    expect(!!Jsspeech).toBe true
