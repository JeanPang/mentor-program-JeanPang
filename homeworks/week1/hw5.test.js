import {add} from './hw5'

describe("hw5", () => {
  it("should return correct answer when a=123 and b=456", () => {
    expect(add('123', '456')).toBe('579')
  })

  it("should return correct answer when a=12312383813881381381 and b=129018313819319831", () => {
    expect(add('12312383813881381381', '129018313819319831')).toBe('12441402127700701212')
  })

  it("should return correct answer when a=1121241294239120391031 and b=35906838359835", () => {
    expect(add('1121241294239120391031', '35906838359835')).toBe('1121241330145958750866')
  })

  it("should return correct answer when a=1121241294239323958638463973723578257823524912313385938529423492342049204120391031 and b=35906833258583928923283928392324892111118359835", () => {
    expect(add('1121241294239323958638463973723578257823524912313385938529423492342049204120391031', '35906833258583928923283928392324892111118359835')).toBe('1121241294239323958638463973723578293730358170897314861813351884666941315238750866')
  })

  it("should return correct answer when a=9 and b=9", () => {
    expect(add('9', '9')).toBe('18')
  })

  it("should return correct answer when a=999 and b=1", () => {
    expect(add('999', '1')).toBe('1000')
  })

  it("should return correct answer when a=999 and b=1", () => {
    expect(add('23', '785')).toBe('808')
  })

})


