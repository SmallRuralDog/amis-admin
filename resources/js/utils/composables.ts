export function useIsMobile() {
  const breakpointRef = useBreakpoint();
  return useMemo(() => {
    return breakpointRef.value === "xs";
  });
}

export function useIsTablet() {
  const breakpointRef = useBreakpoint();
  return useMemo(() => {
    return breakpointRef.value === "s";
  });
}

export function useIsSmallDesktop() {
  const breakpointRef = useBreakpoint();
  return useMemo(() => {
    return breakpointRef.value === "m";
  });
}
