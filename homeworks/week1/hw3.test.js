import {isPrime} from './hw3'

describe("hw3", () => {
  it("should return correct answer when n = 2", () => {
    expect(isPrime(2)).toBe(true)
  })

  it("should return correct answer when n = 3", () => {
    expect(isPrime(3)).toBe(true)
  })

  it("should return correct answer when n = 10", () => {
    expect(isPrime(10)).toBe(false)
  })

  it("should return correct answer when n = 37", () => {
    expect(isPrime(37)).toBe(true)
  })

  it("should return correct answer when n = 38", () => {
    expect(isPrime(38)).toBe(false)
  })

  it("should return correct answer when n = 97939", () => {
    expect(isPrime(97939)).toBe(false)
  })

  it("should return correct answer when n = 97943", () => {
    expect(isPrime(97943)).toBe(true)
  })

})
